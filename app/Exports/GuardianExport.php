<?php

namespace App\Exports;

use App\Models\RegisterManagement\Guardian;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuardianExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function query()
    {
        return Guardian::query()->withWhereHas('region')->orderBy('gender', 'desc');
    }

    public function map($row): array
    {
        return [
            $row->id,
            "'".$row->nik,
            $row->name,
            $row->gender ? 'P' : 'L',
            "'".$row->phone,
            "'".$row->wa_number,
            $row->last_education,
            $row->employment,
            $row->address,
            $row->region->village,
            $row->region->district,
            $row->region->city,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'NAMA',
            'L/P',
            'NO. TELEPON',
            'NO. WA',
            'PENDIDIKAN AKHIR',
            'PEKERJAAN',
            'ALAMAT',
            'DESA',
            'KECAMATAN',
            'KABUPATEN'
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
                'quotePrefix'    => true
            ],
        ];
    }
}
