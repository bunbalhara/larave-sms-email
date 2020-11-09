<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }

    public function getMessageData(){
        $allMessages = Message::orderBy('delivered')->get();

        $dateGroup = $allMessages->groupBy(function ($query){
            return Carbon::parse($query->delivered)->format('Y-m-d');
        });

        $data1 = [];

        foreach ($dateGroup as $date => $item) {
            array_push($data1, ['date' => $date, 'message'=>count($item)]);
        }

        $messageGroup = $allMessages->groupBy('group_id');

        $data2 = [];

        foreach ($messageGroup as $item) {
            array_push($data2, ['date' => Carbon::parse($item[0]->delivered)->format('Y-m-d'), 'message'=>count($item)]);
        }

        return response()->json([
           'status'=>1,
           'data'=>['data1'=>$data1, 'data2'=>$data2],
           'message'=>'',
        ]);
    }
}
