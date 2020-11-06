<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UsersController extends Controller
{
    public function index(){
        $allUsers = User::with('roles')->get();
        $users = $allUsers->reject(function ($user, $key) {
            return $user->hasRole('admin');
        });
        return view('admin.users.index', compact('users'));
    }

    public function fileImport(Request $request)
    {

        $path = $request->file('csv-file')->store('temp');

        $match = [
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => $request->password,
        ];

        try {
            Excel::import(new UsersImport($match), storage_path('app/'.$path));
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

        $result = User::store($request);

        if($result['success']){
            $user = $result['data'];
            return response()->json([
                'status'=>1,
                'view'=> view('admin.users.table-row', compact('user'))->render(),
                'data'=>$user->dataTableRowData()
            ]);
        }

        return  response()->json(['errors'=>$result['errors']]);
    }

    public function edit(Request $request){
        $ids = explode(',', $request->ids);
        $users = User::whereIn('id', $ids)->get();
        $views = [];
        $data = [];
        foreach ($users as $user){
            array_push($views, view('admin.users.edit-row', compact('user'))->render());
            array_push($data, $user->dataTableEditRowData());
        }
        return response()->json([
            'status'=>1,
            'view'=> $views,
            'data'=>$data
        ]);
    }

    public function update(Request  $request){

        $users = User::mUpdate($request);
        $views = [];
        $data = [];

        foreach ($users as $user) {
            array_push($views, view('admin.users.table-row', compact('user'))->render());
            array_push($data, $user->dataTableRowData());
        }

        return response()->json([
            'status'=>1,
            'views'=>$views,
            'data'=>$data
        ]);
    }

    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        User::destroy($ids);
        return response()->json(['status'=>1]);
    }
}
