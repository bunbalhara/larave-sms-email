<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, Sluggable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
                'separator' => '',
                'onUpdate' => true,
                'method'=> null,
            ]
        ];
    }
    public function profileUpdateRule($request)
    {
        $rule['name'] = 'required|max:45';
        $rule['email'] = 'required|email|unique:users,email,' . user()->id;

        return $rule;
    }
    public function updateProfile($request)
    {
        $user = user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if($request->image)
        {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromBase64($request->image)
                ->usingFileName(uniqid() . ".jpg")
                ->toMediaCollection('avatar');
        }
        return $user;

    }

    public function updatePsw($request)
    {
        $user = user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return $user;
    }

    public function avatar()
    {
        $avatar = $this->getFirstMediaUrl('avatar');
        if($avatar!=""||$avatar!=null)
        {
            return $avatar;
        }else {
            return "https://ui-avatars.com/api/?size=300&&name=" . $this->name;
        }
    }

    public static function store($request){
        $user = new self();
        $validation = $user->validate($request);

        if($validation['valid']){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->save();
            return ['success'=>true, 'data'=>$user];
        }
        return ['success'=>false, 'errors'=>$validation['errors']];
    }

    public function validate($request){
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:45',
            'username'=>'required|max:45',
            'email'=>'required|email|unique:users,email,',
            'password'=>'string|required',
            'password_confirm'=>'required|same:password',
            'phone'=>'required|unique:users',
        ]);

        if($validator->passes()){
            return ['valid' => true, 'params'=>$request->all()];
        }

        return ['valid'=> false, 'errors'=>$validator->errors()];
    }

    public static function mUpdate($request)
    {
        $id = $request->id;
        $email = $request->email;
        $username = $request->username;
        $name = $request->name;
        $phone = $request->phone;
        $active = $request->active;

        $users = self::whereIn('id', $id)->get();

        foreach ($users as $i=> $user){
            $user->email = $email[$i];
            $user->username =$username[$i];
            $user->name = $name[$i];
            $user->phone = $phone[$i];
            $user->active = $active[$i];
            $user->save();
            $users[$i] = $user;
        }

        return $users;
    }

    public function dataTableRowData(){
       return ['',
            '<input type="checkbox" class="select-item" data-id="'.$this->id.'"/>',
           $this->name,
           $this->username,
           $this->email,
           $this->phone,
           $this->active?'Active':'Inactive',
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
            '<span hidden>'.$this->username.'</span><input class="input-box"  value="'.$this->username.'" name="username"/>',
            '<span hidden>'.$this->email.'</span><input class="input-box"  value="'.$this->email.'" name="email" type="email"/>',
            '<span hidden>'.$this->phone.'</span><input class="input-box"  value="'.$this->phone.'" name="phone" type="tel"/>',
            '<span hidden>'.($this->active?'Active':'Inactive').'</span><select class="select-box w-100" name="active">
                <option value="1">Active</option>
                <option value="0" '.($this->active?'':'selected').'>Inactive</option>
            </select>',
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
