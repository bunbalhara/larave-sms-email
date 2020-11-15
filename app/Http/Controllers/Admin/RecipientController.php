<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\EmailRecipientsImport;
use App\Imports\RecipientsImport;
use App\Models\Email;
use App\Models\Message;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class RecipientController extends Controller
{

    public function index(Request $request){
        $tab = $request->get('tab');
        $recipients = Recipient::where('phone_number', '!=' ,'')->get();
        $emailRecipients = Recipient::where('email', '!=' ,'')->get();
        return view('admin.recipients.index', compact('recipients','emailRecipients','tab'));
    }

    public function message(Request  $request){
        $recipientId = $request->recipientId;
        $messages = Message::where('recipient_id', $recipientId)->get();
        return view('admin.recipients.message', compact('messages'));
    }

    public function email(Request  $request){
        $recipientId = $request->recipientId;
        $recipient = Recipient::find($recipientId);
        $emails = Email::where('recipients', 'like', '%'.$recipient->email.'%')->get();
        return view('admin.recipients.emails', compact('emails'));
    }


    public function emailFileImport(Request $request){
        $tag = $request->tag;
        $path = $request->file('csv-file')->store('temp');
        try {
            Excel::import(new EmailRecipientsImport($tag), storage_path('app/'.$path));
            return response()->json([
                'status'=>1,
                'data'=>'',
                'message'=>'Imported Successfully!'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status'=>0,
                'errors'=>['Failed to import, something went wrong'],
                'message'=>$e->getMessage()
            ]);
        }
    }

    public function fileImport(Request $request)
    {

        $tag = $request->tag;
        $path = $request->file('csv-file')->store('temp');

        try {
            Excel::import(new RecipientsImport($tag), storage_path('app/'.$path));
            return response()->json([
                'status'=>1,
                'data'=>'',
                'message'=>'Imported Successfully!'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status'=>0,
                'errors'=>['Failed to import, something went wrong'],
                'message'=>$e->getMessage()
            ]);
        }

    }

    public function smsAdd(Request $request){
        $result = Recipient::store($request);

        if($result['status']){
            $recipients = $result['data'];
            $view = [];
            $data = [];
            foreach ($recipients as $recipient){
                array_push($view, view('admin.recipients.table-row', compact('recipient'))->render());
                array_push($data, $recipient->dataTableRowData());
            }
            return response()->json([
                'status'=>1,
                'view'=> $view,
                'data'=>$data
            ]);
        }


        return  response()->json(['status'=>0,'errors'=>$result['errors'],'requests'=>$request->all()]);

    }

    public function smsEdit(Request $request){
        $ids = explode(',', $request->ids);
        $recipients = Recipient::whereIn('id', $ids)->get();
        $data = [];
        foreach ($recipients as $recipient){
            array_push($data, $recipient->dataTableEditRowData());
        }
        return response()->json([
            'status'=>1,
            'data'=>$data
        ]);
    }

    public function smsUpdate(Request $request){
        $recipients = Recipient::mUpdate($request);
        $data = [];

        foreach ($recipients as $recipient) {
            array_push($data, $recipient->dataTableRowData());
        }

        return response()->json([
            'status'=>1,
            'data'=>$data
        ]);
    }


    public function emailAdd(Request $request){

        $validator = Validator::make($request->all(), [
            'email.*'=>'required|email|unique:recipients,email|distinct',
        ]);

        $emails = $request->email;
        $names = $request->name;
        $tags = $request->tag;

        $data = [];

        if($validator->passes()){
            foreach ($emails as $i => $email){
                $recipient = new Recipient();
                $recipient->email = $email;
                $recipient->tag = $tags[$i];
                $recipient->name = $names[$i];
                $recipient->subscribed = true;
                $recipient->save();

                array_push($data, $recipient->dataTableEmailRecipientsData());
            }
            return response()->json([
                'status'=>1,
                'data'=>$data
            ]);
        }

        return  response()->json([
            'status'=>0,
            'errors'=>$validator->errors(),
            'requests'=>$request->all()
        ]);
    }

    public function emailEdit(Request $request){
        $ids = explode(',', $request->ids);
        $recipients = Recipient::whereIn('id', $ids)->get();
        $data = [];
        foreach ($recipients as $recipient){
            array_push($data, $recipient->dataTableEmailEditRowData());
        }
        return response()->json([
            'status'=>1,
            'data'=>$data
        ]);
    }

    public function emailUpdate(Request $request){

        $id = $request->id;
        $emails = $request->email;
        $tag = $request->tag;
        $name = $request->name;
        $subscribed = $request->subscribed;

        $recipients = Recipient::whereIn('id', $id)->get();

        foreach ($recipients as $i=> $recipient){
            $recipient->email = $emails[$i];
            $recipient->tag =$tag[$i];
            $recipient->name = $name[$i];
            $recipient->subscribed = $subscribed[$i];
            $recipient->save();
            $recipients[$i] = $recipient;
        }

        $data = [];

        foreach ($recipients as $recipient) {
            array_push($data, $recipient->dataTableEmailRecipientsData());
        }

        return response()->json([
            'status'=>1,
            'data'=>$data
        ]);
    }

    public function emails(){

    }

    public function emailCsvImport(){

    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Recipient::destroy($ids);
        return response()->json(['status'=>1]);
    }
}
