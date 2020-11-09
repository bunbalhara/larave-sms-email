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
    ];

    public static function store($request){
        $recipient = new self();
        $validation = $recipient->validate($request);
        $recipients = [];
        if($validation['valid']){
            $name = $request->name;
            $phone_number = $request->phone_number;
            foreach($phone_number as $i => $item){
                $recipient = new self();
                $recipient->phone_number = $item;
                $recipient->country = PhoneNumber::make($item)->getCountry();
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

    public function dataTableRowData(){
        return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'"/>',
            $this->name,
            $this->country.'<img src="'.asset('assets/img/flags/'.$this->country.'.png').'">',
            $this->phone_number,
            '<span class="badge badge-success">Yes</span>',
            '<div class="w-100 d-flex justify-content-around align-items-center">
                <button class="btn btn-sm btn-view view-item '.($this->messageCount()==0?'disabled':'').'"  data-id="'.$this->id.'">
                    <div><i class="fa fa-eye"></i>Messages('.$this->messageCount().')</div>
                </button>
                <button class="btn btn-sm btn-delete delete-item" data-id="'.$this->id.'">
                    <div><i class="fa fa-trash"></i> Delete</div>
                </button>
            </div>'];
    }

    public function message(){
        return $this->hasMany('App\Models\Message');
    }

}
