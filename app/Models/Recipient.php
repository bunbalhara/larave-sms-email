<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\PhoneNumber;

class Recipient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'country',
        'email',
        'tag'
    ];
    public static function store($request){
        $recipient = new self();
        $validation = $recipient->validate($request);
        $recipients = [];
        if($validation['valid']){
            $name = $request->name;
            $phone_number = $request->phone_number;
            $tag = $request->tag;
            foreach($phone_number as $i => $item){
                $recipient = new self();
                $recipient->phone_number = $item;
                $recipient->subscribed = true;
                $recipient->country = PhoneNumber::make($item)->getCountry();
                $recipient->tag = $tag[$i];
                if($name[$i]){
                    $recipient->name = $name[$i];
                }else{
                    $recipient->name = $recipient->country.':'.$recipient->phone_number;
                }
                $recipient->save();
                array_push($recipients, $recipient);
            }
            return ['status'=>1, 'data'=>$recipients];
        }
        return ['status'=>0, 'errors'=>$validation['errors']];
    }

    public function validate($request){

        $validator = Validator::make($request->all(), [
            'phone_number.*'=>'required|unique:recipients,phone_number|phone:AUTO|distinct',
        ]);

        if($validator->passes()){
            return ['valid' => true, 'params'=>$request->all()];
        }

        return ['valid'=> false, 'errors'=>$validator->errors()];
    }

    public static function mUpdate($request)
    {
        $id = $request->id;
        $phone_number = $request->phone_number;
        $tag = $request->tag;
        $name = $request->name;
        $subscribed = $request->subscribed;

        $recipients = self::whereIn('id', $id)->get();

        foreach ($recipients as $i=> $recipient){
            $recipient->phone_number = $phone_number[$i];
            $recipient->tag =$tag[$i];
            $recipient->name = $name[$i];
            $recipient->subscribed = $subscribed[$i];
            $recipient->save();
            $recipients[$i] = $recipient;
        }

        return $recipients;
    }

    public function dataTableRowData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'"/>',
            $this->name,
            $this->country?$this->country.'<img src="'.asset('assets/img/flags/'.strtolower($this->country).'.png').'">':'undefined',
            $this->phone_number,
            $this->tag,
            $this->subscribed?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                <a href="'.route('admin.recipient.message',['recipientId'=>$this->id]).'" class="btn btn-sm btn-edit view-item mr-1 '.($this->message()->count()==0?'disabled':'').'" data-id="{{$recipient->id}}">
                    <div><i class="fa fa-eye"></i>Messages('.$this->message()->count().')</div>
                </a>
                <button class="btn btn-sm btn-edit edit-item mr-1" data-id="'.$this->id.'">
                    <div><i class="fa fa-trash"></i> Edit </div>
                </button>
                <button class="btn btn-sm btn-delete delete-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-trash"></i> Delete </div>
                </button>
            </div>'];
    }

    public function dataTableEditRowData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'" checked disabled/>',
            '<span hidden>'.$this->name.'</span><input class="input-box" value="'.$this->name.'" name="name"/>',
            $this->country?$this->country.'<img src="'.asset('assets/img/flags/'.strtolower($this->country).'.png').'">':'undefined',
            '<span hidden>'.$this->phone_number.'</span><input class="input-box"  value="'.$this->phone_number.'" name="phone_number"/>',
            '<span hidden>'.$this->tag.'</span><input class="input-box"  value="'.$this->tag.'" name="tag" type="text"/>',
            '<span hidden>'.($this->subscribed?'Yes':'No').'</span><select class="select-box w-100" name="subscribed">
                <option value="1">Yes</option>
                <option value="0" '.($this->subscribed?'':'selected').'>No</option>
            </select>',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                <a href="'.route('admin.recipient.message',['recipientId'=>$this->id]).'" class="btn btn-sm btn-edit view-item mr-1 '.($this->message()->count()==0?'disabled':'').'" data-id="{{$recipient->id}}">
                    <div><i class="fa fa-eye"></i>Messages('.$this->message()->count().')</div>
                </a>
                <button class="btn btn-sm btn-danger cancel-item mr-1" data-id="'.$this->id.'">
                    <div><i class="fa fa-times"></i>Close</div>
                </button>
                <button class="btn btn-sm btn-save update-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-save"></i> Save</div>
                </button>
            </div>'];
    }

    public function dataTableEmailRecipientsData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'"/>',
            $this->name,
            $this->email,
            $this->tag,
            $this->subscribed?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                <a href="'.route('admin.recipient.message',['recipientId'=>$this->id]).'" class="btn btn-sm btn-edit view-item mr-1 '.($this->message()->count()==0?'disabled':'').'" data-id="{{$recipient->id}}">
                    <div><i class="fa fa-eye"></i>Emails('.$this->message()->count().')</div>
                </a>
                <button class="btn btn-sm btn-edit edit-item mr-1" data-id="'.$this->id.'">
                    <div><i class="fa fa-trash"></i> Edit </div>
                </button>
                <button class="btn btn-sm btn-delete delete-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-trash"></i> Delete </div>
                </button>
            </div>'];
    }

    public function dataTableEmailEditRowData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'" checked disabled/>',
            '<span hidden>'.$this->name.'</span><input class="input-box" value="'.$this->name.'" name="name"/>',
            '<span hidden>'.$this->email.'</span><input class="input-box"  value="'.$this->email.'" name="email"/>',
            '<span hidden>'.$this->tag.'</span><input class="input-box"  value="'.$this->tag.'" name="tag" type="text"/>',
            '<span hidden>'.($this->subscribed?'Yes':'No').'</span><select class="select-box w-100" name="subscribed">
                <option value="1">Yes</option>
                <option value="0" '.($this->subscribed?'':'selected').'>No</option>
            </select>',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                <a href="'.route('admin.recipient.message',['recipientId'=>$this->id]).'" class="btn btn-sm btn-edit view-item mr-1 '.($this->message()->count()==0?'disabled':'').'" data-id="{{$recipient->id}}">
                    <div><i class="fa fa-eye"></i>Emails('.$this->message()->count().')</div>
                </a>
                <button class="btn btn-sm btn-danger cancel-item mr-1" data-id="'.$this->id.'">
                    <div><i class="fa fa-times"></i>Close</div>
                </button>
                <button class="btn btn-sm btn-save update-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-save"></i> Save</div>
                </button>
            </div>'];
    }

    public function message(){
        return $this->hasMany('App\Models\Message');
    }

    public function emailCount(){
        $emails = Email::where('recipients', 'like', '%'.$this->email.'%')->get();
        return count($emails);
    }

    public function unsubscribe(){
        $this->subscribed = false;
        $this->save();
    }
}
