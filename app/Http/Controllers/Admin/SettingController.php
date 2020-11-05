<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        $senders = Sender::all();
        return view('admin.settings.index', compact('senders'));
    }

    public function set(Request $request){

        $validator = Validator::make($request->all(),[
            'twilio_account_sid'=>'required|string|size:34',
            'twilio_account_token'=>'required|string|size:32'
        ]);

        if($validator->passes()){
            foreach ($request->all() as $key=>$value){
                option([$key => $value]);
            }
            return response()->json(['status'=>1,'data'=>$request->all(),'message'=>'']);
        }

        return response()->json(['success'=>0, 'errors'=>$validator->errors(),'message'=>'']);
    }
}
