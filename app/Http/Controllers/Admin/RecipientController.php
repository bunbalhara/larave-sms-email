<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\RecipientsImport;
use App\Models\Message;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RecipientController extends Controller
{

    public function index(){

        $recipients = Recipient::all();

        return view('admin.recipients.index', compact('recipients'));
    }

    public function message(Request  $request){
        $recipientId = $request->recipientId;
        $messages = Message::where('recipient_id', $recipientId)->get();
        return view('admin.recipients.message', compact('messages'));
    }

    public function fileImport(Request $request)
    {

        $path = $request->file('csv-file')->store('temp');

        try {
            Excel::import(new RecipientsImport(), storage_path('app/'.$path));
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

    public function add(Request $request){
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

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Recipient::destroy($ids);
        return response()->json(['status'=>1]);
    }
}
