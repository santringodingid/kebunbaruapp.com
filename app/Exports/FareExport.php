<?php

namespace App\Exports;

use App\Models\PaymentManagement\Fare;
use Maatwebsite\Excel\Concerns\FromCollection;

class FareExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fare::all();
    }
}
