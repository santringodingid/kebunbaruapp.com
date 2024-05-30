<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class GradePaymentExport implements FromView
{
    use Exportable;

    public function __construct($grade, $institution)
    {
        $this->grade = $grade;
        $this->institution = $institution;
    }

    public function view(): View
    {
        $recapitulations = DB::table('registrations')->join('students', function (JoinClause $joinClause){
                $joinClause->on('registrations.id', '=', 'students.id')
                    ->where([
                        ['students.gender', '=', session('gender_access')],
                        ['students.status', '=', 1]
                    ])
                    ->join('regions', 'students.region_id', '=', 'regions.id');
            })->join('institutions', 'institutions.id', '=', 'registrations.institution_diniyah_id')
            ->leftJoin('payments', function (JoinClause $joinClause){
                $joinClause->on('registrations.id', '=', 'payments.registration_id')
                    ->orderBy('created_at', 'desc');
            })->when($this->grade, function ($query, $grade) {
                $query->where('registrations.grade_of_diniyah', '=', $grade);
            })->when($this->institution, function ($query, $institution) {
                $query->where('registrations.institution_diniyah_id', '=', $institution);
            })->select(
                'registrations.id as id', 'registrations.domicile_status as domicile_status',
                'registrations.domicile as domicile', 'registrations.domicile_number as domicile_number',
                'registrations.grade_of_diniyah as grade', 'students.name as name', 'institutions.shortname as institution',
                'regions.village as village', 'regions.city as city', 'payments.id as payment', 'payments.is_paid as status',
            )->get();

        return view('pages.excel.grade-payment', compact('recapitulations'));
    }
}
