<?php

namespace App\Exports;

use App\Models\RegisterManagement\Registration;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class RegistrationExport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Registration::all();
    }

    public function map($registration): array
    {
        return [
            $registration->id,
            $registration->domicile_status
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'NAMA'
        ];
    }
}
