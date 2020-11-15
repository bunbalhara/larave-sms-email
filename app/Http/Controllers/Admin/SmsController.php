<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SimpleMail;
use App\Models\Email;
use App\Models\Message;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    public function index(){

        $messages = Message::all()->groupBy('group_id');

        return view('admin.messages.index', compact('messages'));
    }

    public function detail(Request $request){
        $group_id = $request->get('msgId');
        $messages = Message::where('group_id', $group_id)->get();
        return view('admin.messages.detail', compact('messages'));
    }

    public function newEmail(){
        $recipients = Recipient::where('subscribed', true)
            ->where('email','!=','')
            ->get();

        $tags = Recipient::where('email','!=','')->distinct()->get(['tag'])->pluck('tag');

        return view('admin.messages.new-email', compact('recipients','tags'));
    }


    public function newMessage(){

        $recipients = Recipient::where('subscribed', true)
            ->whereNotIn('country', ['0'])->get();

        $countries = Recipient::distinct()->get(['country'])->pluck('country');
        $tags = Recipient::distinct()->get(['tag'])->pluck('tag');

        return view('admin.messages.new', compact('recipients','countries','tags'));
    }

    public function sendEmail(Request $request){

        $validator = Validator::make(array_merge($request->all()), [
            'from'=>'required|email',
            'receivers' => 'required',
            'message' => 'required',
            'subject' => 'required',
        ]);

        if($validator->passes()){
            $numbers_in_arrays = explode( ',' , $request->receivers );
            $recipients = Recipient::whereIn('id', $numbers_in_arrays)->get();
            $from = $request->from;
            $subject = $request->subject;
            $content = $request->message;
            $count = 0;
            $to = [];
            foreach( $recipients as $recipient )
            {
                $count++;
                array_push($to, $recipient->email);
            }

            $email = new Email();
            $email->recipients = implode(',',$to);
            $email->from = $from;
            $email->content = $content;
            $email->subject = $subject;
            $email->mailer = option('mail_mailer','smtp');
            $email->save();

            $newEmail = new SimpleMail($from, $subject, $content);
            Mail::to($to)->send($newEmail);
            return response()->json([
                'status' => 1,
                'data'=>$request->message,
                'message'=>$count . " email sent!"
            ]);
        }
        return response()->json([
            'status' => 0,
            'errors'=>$validator->errors(),
            'message'=>"Something went wrong!"
        ]);
    }

    public function emailUploadImage(Request $request){
        try{
            $files = $request->file('file');
            $paths = [];
            foreach ($files as $file){
                $name = uniqid() . '_' . trim($file->getClientOriginalName());
                $path= asset('images/email/'.$name);
                $file->move(public_path('images/email/'), $name);
                array_push($paths, $path);
            }

            return response()->json([
               'status'=>1,
                'data'=>[
                    'paths'=>$paths
                ]
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'state'=>1,
                'message'=>$e->getMessgetMessage()
            ]);
        }
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
        $message = Message::where('message_sid', $request->MessageSid)->first();
        $message->status = $request->SmsStatus;
        $message->error_code = $request->ErrorCode??'';
        $message->save();
        return "success";
    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Message::whereIn('group_id', $ids)->delete();
        return response()->json(['status'=>1]);
    }

    public function deleteMessage(Request  $request){
        $ids = explode(',', $request->ids);
        Message::destroy($ids);
        return response()->json(['status'=>1,'message'=>count($ids).' messages deleted!']);
    }
}
