<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    public function index(){
        $messages = Message::all();

        return view('admin.messages.index', compact('messages'));
    }

    public function newMessage(){

        $allUsers = User::with('roles')->get();
        $users = $allUsers->reject(function ($user, $key) {
            return $user->hasRole('admin');
        });

        $current_sender_id = option('current_sender',null);

        if($current_sender_id) $defaultSender = Sender::find($current_sender_id);

        $senders = Sender::all();

        return view('admin.messages.new', compact('users','defaultSender', 'senders'));
    }

    public function sendSms(Request $request){

        $twilio_account_sid    = option('twilio_account_sid');
        $twilio_account_token  = option( 'twilio_account_token' );

        $validator = Validator::make(array_merge($request->all(),['twilio_account_sid'=>$twilio_account_sid,'twilio_account_token'=>$twilio_account_token]), [
            'twilio_account_sid'=>'required|string|size:34',
            'twilio_account_token'=>'required|string|size:32',
            'sender'=>'required',
            'receivers' => 'required',
            'message' => 'required'
        ]);

        if ( $validator->passes() ) {

            $client = new Client( $twilio_account_sid, $twilio_account_token );
            $numbers_in_arrays = explode( ',' , $request->receivers );
            $sender = Sender::find($request->sender);
            $users = User::whereIn('id', $numbers_in_arrays)->get();
            $message = $request->input( 'message' );
            $count = 0;
            try {
                foreach( $users as $user )
                {
                    $count++;
                    $client->messages->create(
                        $user->phone,
                        [
                            'from' => $sender->number,
                            'body' => $message,
                        ]
                    );
//                $client->messages->create(
//                    '+8615604256076',
//                    [
//                        'from' => '+32460204024',
//                        'body' => 'Test Message',
//                    ]
//                );
                }

                $newMessage = new Message();
                $newMessage->sender_id = $sender->id;
                $newMessage->receivers = $request->receivers;
                $newMessage->content = $message;
                $newMessage->delivered = date('Y-m-d h:m:s');

                $newMessage->save();

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

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Message::destroy($ids);
        return response()->json(['status'=>1]);
    }
}
