<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(user()->hasRole('admin'))
        {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    public function profile($role)
    {
        if(!in_array($role, ['admin', 'account'])) abort(404);
        return view('account.profile');
    }
    public function profileUpdate(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), user()->profileUpdateRule($request));
            if($validation->fails()) return response()->json(['status'=>0, 'data'=>$validation->errors()]);

            $user = user()->updateProfile($request);

            return response()->json([
                'status'=>1,
                'data'=>$user
            ]);
        }catch(\Exception $e)
        {
            return response()->json([
                'status'=>0,
                'data'=>[json_encode($e->getMessage())]
            ]);
        }
    }
    public function passwordUpdate(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'old_password' => [
                    function ($attribute, $value, $fail) {
                        if (user()->password!==null&&!Hash::check($value, user()->password)) {
                            $fail('Old Password didn\'t match');
                        }
                    },
                ],
                'new_password' => 'required|min:8|different:old_password',
                'confirm_password' =>'required|same:new_password'
            ]);
            if($validation->fails()) return response()->json(['status'=>0, 'data'=>$validation->errors()]);

            $user = user()->updatePsw($request);

            return response()->json([
                'status'=>1,
                'data'=>$user
            ]);
        }catch(\Exception $e)
        {
            return response()->json([
                'status'=>0,
                'data'=>[json_encode($e->getMessage())]
            ]);
        }
    }
    public function uploadImage(Request $request)
    {
        try{
            $file=$request->file('file');
            $name = uniqid() . '.'.$file->getClientOriginalExtension();
            $file->move(storage_path('app/public/uploads'), $name);
            $path= url('/media/uploads') . "/" . $name;
            \Log::info($path);
            return response()->json([
                'location' => $path
            ]);
        }
        catch(\Exception $e){
            echo json_encode($e->getMessage());
        }
    }
}
