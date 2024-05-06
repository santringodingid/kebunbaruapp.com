<?php

namespace App\Exports;

use App\Models\RegisterManagement\Registration;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function query()
    {
        return Registration::query()->withWhereHas('student', function ($query) {
            $query->where('status', '>', 0)->with(['region', 'diniyah', 'formal']);
        })->orderBy('is_new_domicile', 'desc');
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->student->name,
            $row->student->status,
            $row->domicile_status ? 'P2K' : 'LP2K',
            $row->is_new_domicile ? 'Baru' : 'Lama',
            $row->domicile,
            $row->domicile_number,
            $row->grade_of_diniyah,
            $row->diniyah->name,
            $row->is_new_diniyah ? 'Baru' : 'Lama',
            $row->grade_of_formal,
            $row->formal->name,
            $row->is_new_formal ? 'Baru' : 'Lama',
            $row->student->address,
            $row->student->region->village,
            $row->student->region->district,
            $row->student->region->city,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'NAMA',
            'STATUS',
            'STATUS DOMISILI',
            'STATUS MASUK DOMISILI',
            'DOMISILI',
            'NOMOR',
            'KELAS DINIYAH',
            'TINGKAT DINIYAH',
            'STATUS MASUK DINIYAH',
            'KELAS FORMAL',
            'TINGKAT FORMAL',
            'STATUS MASUK FORMAL',
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
