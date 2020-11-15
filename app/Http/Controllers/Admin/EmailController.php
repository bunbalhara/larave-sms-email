<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(){
        $emails = Email::all();
        return view('admin.email.index', compact('emails'));
    }

    public function detail(Request $request){

    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        Email::whereIn('id', $ids)->delete();
        return response()->json(['status'=>1]);
    }
}
