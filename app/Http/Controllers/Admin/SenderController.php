<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sender;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    public function index(){
        $senders = Sender::all();
        return view('admin.senders.index', compact('senders'));
    }


    public function add(Request $request){
        $result = Sender::store($request);

        if($result['success']){
            $sender = $result['data'];
            return response()->json([
                'status'=>1,
                'view'=> view('admin.senders.table-row', compact('sender'))->render(),
                'data'=>$sender->dataTableRowData()
            ]);
        }
        return  response()->json(['errors'=>$result['errors']]);
    }

    public function edit(Request $request){
        $ids = explode(',', $request->ids);
        $senders = Sender::whereIn('id', $ids)->get();
        $views = [];
        $data = [];
        foreach ($senders as $sender){
            array_push($views, view('admin.senders.edit-row', compact('sender'))->render());
            array_push($data, $sender->dataTableEditRowData());
        }
        return response()->json([
            'status'=>1,
            'view'=> $views,
            'data'=>$data
        ]);
    }

    public function update(Request  $request){

        $senders = Sender::mUpdate($request);
        $views = [];
        $data = [];

        foreach ($senders as $sender) {
            array_push($views, view('admin.senders.table-row', compact('sender'))->render());
            array_push($data, $sender->dataTableRowData());
        }

        return response()->json([
            'status'=>1,
            'views'=>$views,
            'data'=>$data
        ]);
    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Sender::destroy($ids);
        return response()->json(['status'=>1]);
    }
}
