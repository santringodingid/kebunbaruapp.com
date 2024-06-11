<?php

namespace App\Exports;

use App\Models\RegisterManagement\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    use Exportable;

    public function query()
    {
        return Student::query()->with(['period', 'region', 'guardian' => function ($query) {
            $query->with('region');
        }]);
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->registration_number,
            $row?->period->diniyah,
            "'".$row->nik,
            "'".$row->kk,
            $row->name,
            $row->gender ? 'P' : 'L',
            $row->place_of_birth,
            Date::dateTimeToExcel($row->date_of_birth),
            $row->father,
            $row->mother,
            $row->address,
            $row->region->village,
            $row->region->district,
            $row->region->city,
            "'".$row->guardian->nik,
            $row->guardian->name,
            $row->guardian->gender ? 'P' : 'L',
            "'".$row->guardian->phone,
            "'".$row->guardian->wa_number,
            $row->guardian->last_education,
            $row->guardian->employment,
            $row->guardian->address,
            $row->guardian?->region?->village,
            $row->guardian?->region?->district,
            $row->guardian?->region?->city,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'REG',
            'TAHUN PERIODE',
            'NIK',
            'KK',
            'NAMA',
            'L/P',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'AYAH',
            'IBU',
            'ALAMAT',
            'DESA',
            'KECAMATAN',
            'KABUPATEN',
            'NIK WALI',
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
            ],
        ];
    }
}
