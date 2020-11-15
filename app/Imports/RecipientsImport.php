<?php

namespace App\Imports;

use App\Models\Recipient;
use Maatwebsite\Excel\Concerns\ToModel;
use Propaganistas\LaravelPhone\PhoneNumber;

class RecipientsImport implements ToModel
{

    private $tag;

    /**
     * RecipientsImport constructor.
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $number = str_replace(" ","",$row[0]);
        $number = str_replace("-","",$number);
        $number = str_replace("(","",$number);
        $number = str_replace(")","",$number);

        if(strpos($number,"+") === false){
            $phoneNumber = '+'.$number;
        }else{
            $phoneNumber = $number;
        }

        try {

            $country = PhoneNumber::make($phoneNumber)->getCountry();

            return new Recipient([
                'name'=>$country.':'.$phoneNumber,
                'country'=> $country,
                'tag'=>$this->tag,
                'phone_number'=>$phoneNumber,
            ]);

        }catch (\Exception $exception){
            return new Recipient([
                'name'=>"Invalid phone number",
                'country'=> 0,
                'tag'=>$this->tag??'-',
                'phone_number'=>$phoneNumber,
            ]);
        }
    }
}
