<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Sender extends Model
{
    use HasFactory;

    public static function store($request){
        $sender = new self();
        $validation = $sender->validate($request);

        if($validation['valid']){
            $sender->name = $request->name;
            $sender->number = $request->number;
            $sender->comment = $request->comment;
            $sender->save();
            return ['success'=>true, 'data'=>$sender];
        }
        return ['success'=>false, 'errors'=>$validation['errors']];
    }

    public function validate($request){
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:45',
            'number'=>'required|unique:senders'
        ]);

        if($validator->passes()){
            return ['valid' => true, 'params'=>$request->all()];
        }

        return ['valid'=> false, 'errors'=>$validator->errors()];
    }

    public static function mUpdate($request)
    {
        $id = $request->id;
        $name = $request->name;
        $number = $request->number;
        $comment = $request->comment;

        $senders = self::whereIn('id', $id)->get();

        foreach ($senders as $i=> $sender){
            $sender->name = $name[$i];
            $sender->number =$number[$i];
            $sender->comment = $comment[$i];
            $sender->save();
            $senders[$i] = $sender;
        }

        return $senders;
    }

    public function dataTableRowData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'"/>',
            $this->name,
            $this->number,
            $this->comment,
            '0',
            option('current_sender')==$this->id?'<span class="badge badge-success">Selected</span>':'',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                    <button class="btn btn-sm btn-edit edit-item" data-id="'.$this->id.'">
                        <div><i class="fa fa-edit"></i> Edit</div>
                    </button>
                    <button class="btn btn-sm btn-delete delete-item" data-id="'.$this->id.'">
                        <div><i class="fa fa-trash"></i> Delete</div>
                    </button>
                </div>'];
    }

    public function dataTableEditRowData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'" checked disabled/>',
            '<span hidden>'.$this->name.'</span><input class="input-box" value="'.$this->name.'" name="name"/>',
            '<span hidden>'.$this->number.'</span><input class="input-box"  value="'.$this->number.'" name="number"/>',
            '<span hidden>'.$this->comment.'</span><input class="input-box"  value="'.$this->comment.'" name="comment" />',
            '<input  class="input-box"  value="0" disabled/>',
            option('current_sender')==$this->id?'<span class="badge badge-success">Selected</span>':'',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                <button class="btn btn-sm btn-danger cancel-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-times"></i>Close</div>
                </button>
                <button class="btn btn-sm btn-save update-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-save"></i> Save</div>
                </button>
            </div>'];
    }
}
