<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{

    private $match;

    /**
     * UsersImport constructor.
     * @param $match
     */
    public function __construct($match)
    {
        $this->match = $match;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $param = [];
        foreach ($this->match as $key => $value){
            if($key == 'password'){
                $param[$key] = Hash::make($row[$value]);
            }else{
                $param[$key] = $row[$value];
            }
        }
        return new User($param);
    }
}
