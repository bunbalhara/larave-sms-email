<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    public function index(){
        $messages = Message::all()->groupBy('group_id');
        return view('admin.messages.index', compact('messages'));
    }

    public function newMessage(){
        $recipients = Recipient::all();
        return view('admin.messages.new', compact('recipients'));
    }

    public function sendSms(Request $request){

        $twilio_account_sid    = option('twilio_account_sid');
        $twilio_account_token  = option( 'twilio_account_token' );

        $validator = Validator::make(array_merge($request->all(),['twilio_account_sid'=>$twilio_account_sid,'twilio_account_token'=>$twilio_account_token]), [
            'twilio_account_sid'=>'required|string|size:34',
            'twilio_account_token'=>'required|string|size:32',
            'serviceSid'=>'required',
            'receivers' => 'required',
            'message' => 'required'
        ]);


        if ( $validator->passes() ) {
            $client = new Client( $twilio_account_sid, $twilio_account_token );
            $numbers_in_arrays = explode( ',' , $request->receivers );
            $recipients = Recipient::whereIn('id', $numbers_in_arrays)->get();
            $message = $request->message;

            $service = $client->messaging->v1->services($request->serviceSid)->fetch();
            $alphaSenders =  $client->messaging->v1->services($request->serviceSid)->alphaSenders->read();
            $groupId = uniqid('msg_');
            $count = 0;
            try {
                foreach( $recipients as $recipient )
                {
                    $count++;
                    $result = $client->messages->create(
                        $recipient->phone_number,
                        [
                            'messagingServiceSid' => $request->serviceSid,
                            'body' => $message,
                            "statusCallback" => 'https://sms.webbb.site/admin/message/status-callback'
                        ]
                    );

                    $newMessage = new Message();
                    $newMessage->group_id = $groupId;
                    $newMessage->message_sid = $result->sid;
                    $newMessage->service_sid = $request->serviceSid;
                    $newMessage->service_name = $service->friendlyName;
                    $newMessage->sender_number = $result->to;
                    $newMessage->sender_name = $alphaSenders[0]->alphaSender;
                    $newMessage->recipient_id = $recipient->id;
                    $newMessage->content = $message;
                    $newMessage->delivered = date('Y-m-d h:m:s');
                    $newMessage->save();
                }

                return response()->json([
                    'status' => 1,
                    'data'=>'',
                    'message'=>$count . " messages sent!"
                ]);

            }catch (\Exception $e){
                return response()->json([
                    'status' => 0,
                    'errors'=>['Check your twilio credentials or sender number'],
                    'message'=>$e->getMessage()
                ]);
            }

        } else {
            return response()->json([
                'status' => 0,
                'errors'=>$validator->errors(),
                'message'=>"Something went wrong!"
            ]);
        }
    }

    public function statusCallback(Request $request){
        Log::info("Status Callback Function");
        Log::info($request->MessageSid);
        $message = Message::where('message_sid', $request->MessageSid)->first();
        $message->status = $request->SmsStatus;
        $message->save();
        return "success";
    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Message::whereIn('group_id', $ids)->delete();
        return response()->json(['status'=>1]);
    }
}
