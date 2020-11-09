<?php

namespace App\Imports;

use App\Models\Recipient;
use Maatwebsite\Excel\Concerns\ToModel;
use Propaganistas\LaravelPhone\PhoneNumber;

class RecipientsImport implements ToModel
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if(strpos($row[0],"+")){
            $phoneNumber = $row[0];
        }else{
            $phoneNumber = '+'.$row[0];
        }

        $country = PhoneNumber::make($phoneNumber)->getCountry();

        return new Recipient([
            'name'=>$country.':'.$phoneNumber,
            'country'=> $country,
            'phone_number'=>$phoneNumber,
        ]);
    }
}
