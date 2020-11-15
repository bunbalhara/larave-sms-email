<?php

namespace App\Imports;

use App\Models\Recipient;
use Maatwebsite\Excel\Concerns\ToModel;

class EmailRecipientsImport implements ToModel
{
    private $tag;

    /**
     * RecipientsImport constructor.
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function model(array $row)
    {
        return new Recipient([
            'name'=>'',
            'email'=> $row[0],
            'tag'=>$this->tag,
        ]);
    }
}
