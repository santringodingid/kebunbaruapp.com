<?php

namespace App\Exports;

use App\Models\PaymentManagement\Fare;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FareExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function query()
    {
        return Fare::query()->with(['institution' => function ($query) {
            $query->whereIn('gender_access', [session()->get('gender_access'), 2]);
        }]);
    }

    public function map($row): array
    {
        return [
            $row->grade,
            $row?->institution?->name,
            $row->domicile_status ? 'P2K' : 'LP2K',
            $row->getRawOriginal('amount')
        ];
    }

    public function headings(): array
    {
        return [
            'KELAS',
            'TINGKAT',
            'STATUS DOMISILI',
            'NOMINAL'
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
