<?php

namespace App\Livewire\PaymentManagement\Recapitulation;

use App\Models\SettingManagement\Institution;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Grade extends Component
{
    use WithPagination;
    public $diniyahs;
    public $search;
    public $grade;
    public $institution;

    public $selectedGrade;
    public $selectedInstitution;
    public function mount()
    {
        $gender = session()->get('gender_access');
        $this->diniyahs = Institution::query()->whereIn('gender_access', [$gender, 2])
            ->where(['status' => 0, 'status_access' => 1])->get();
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div>
            <div class="d-flex align-items-center pt-6 text-muted">
                <span>Data sedang dimuat...</span>
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
        HTML;
    }
    public function updatedGrade(): void
    {
        $this->selectedGrade = $this->grade;
    }

    public function updatedInstitution(): void
    {
        $this->selectedInstitution = $this->institution;
    }
    public function render(): View
    {
        $recapitulations = DB::table('registrations')
            ->join('students', function (JoinClause $joinClause){
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
            })->when($this->search, function ($query, $search){
                $query->whereAny(['students.name', 'students.id'], 'LIKE', "%{$search}%");
            })->select(
                'registrations.id as id', 'registrations.domicile_status as domicile_status',
                'registrations.domicile as domicile', 'registrations.domicile_number as domicile_number',
                'registrations.grade_of_diniyah as grade', 'students.name as name', 'institutions.shortname as institution',
                'regions.village as village', 'regions.city as city', 'payments.id as payment', 'payments.is_paid as status',
            )->paginate(12);

        return view('livewire.payment-management.recapitulation.grade', compact('recapitulations'));
    }

    public function updatingGrade(): void
    {
        $this->resetPage();
    }

    public function updatingInstitution(): void
    {
        $this->resetPage();
    }
}
