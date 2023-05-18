<?php

namespace App\Imports;

use App\CmsNova;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CmsNova([
           'norek'     => $row[0],
        ]);
    }
}
