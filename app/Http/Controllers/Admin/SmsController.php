<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class SmsController extends Controller
{

    public function index(){
        $messages = Message::all();
        return view('admin.messages.index', compact('messages'));
    }

    public function newMessage(){
        return view('admin.messages.new');
    }

    public function sendSms(){

    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Message::destroy($ids);
        return response()->json(['status'=>1]);
    }
}
