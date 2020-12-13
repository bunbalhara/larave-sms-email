<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){

        $content = "This si simple email";

        return view('admin.messages.mail.simple-mail', compact('content'));
    }
}
