<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Email;
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
            array_push($data2, ['date' => $item[0]->delivered, 'message'=>count($item)]);
        }


        $allEmails = Email::orderBy('created_at')->get();

        $dateGroup = $allEmails->groupBy(function ($query){
            return Carbon::parse($query->created_at)->format('Y-m-d');
        });

        $data3 = [];

        foreach ($dateGroup as $date => $item) {
            array_push($data3, ['date' => $date, 'email'=>count($item)]);
        }

        $data4 = [];

        foreach ($allEmails as $item) {
            array_push($data4, ['date' => Carbon::parse($item->created_at)->format('Y-m-d h:m:s'), 'email'=>count($item->recipients())]);
        }

        return response()->json([
           'status'=>1,
           'data'=>[ 'data1'=>$data1, 'data2'=>$data2, 'data3'=>$data3, 'data4'=>$data4 ],
           'message'=>'',
        ]);
    }
}
