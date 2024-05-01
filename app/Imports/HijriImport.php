<?php

namespace App\Imports;

use App\Models\SettingManagement\Hijri;
use Maatwebsite\Excel\Concerns\ToModel;

class HijriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row): \Illuminate\Database\Eloquent\Model|Hijri|null
    {
        return new Hijri([
            'hijri' => $row[1],
            'masehi' => $row[2]
        ]);
    }
}
