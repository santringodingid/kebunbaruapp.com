<?php

namespace App\Exports;

use App\Models\LicensingManagement\Recapitulation;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LicenseExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function query()
    {
        $gender = session('gender_access');

        return Recapitulation::query()->with('petition', function ($query){
            $query->with('registration', function ($query){
                $query->with('diniyah', 'formal');
            })->with('student');
        })->when($gender != 2, function ($q) use ($gender) {
            $q->where('gender', $gender);
        })->orderBy('id', 'desc');
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->petition->student->id,
            $row->petition->student->name,
            $row->petition->registration->domicile,
            $row->petition->registration->domicile_number,
            $row->petition->registration->grade_of_diniyah,
            $row->petition->registration->diniyah->shortname,
            $row->petition->registration->grade_of_formal,
            $row->petition->registration->formal->shortname,
            $row->petition->created_at_hijri,
            $row->petition->reason.' – '.$row->petition->note,
            $row->status
        ];
    }

    public function headings(): array
    {
        return [
            'REG',
            'ID',
            'NAMA',
            'DOMISILI',
            'NOMOR',
            'KELAS DINIYAH',
            'TINGKAT DINIYAH',
            'KELAS FORMAL',
            'TINGKAT FORMAL',
            'TANGGAL IZIN',
            'ALASAN',
            'STATUS'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }
}
