<?php

namespace App\Livewire\RegisterManagement\Student;

use App\Models\Domicile;
use App\Models\RegisterManagement\Student;
use App\Models\SettingManagement\Period;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;
    public $period;
    public $domicile;
    public $periods;

    public $domiciles;
    use WithPagination;

    public function mount()
    {
        $this->period = '';
        $gender = session()->get('gender_access');

        $this->domiciles = Domicile::query()->where('gender', $gender)->get();
        $this->periods = Period::orderBy('id', 'desc')->get();
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

    #[On('success_store')]
    public function render(): View
    {
        $students = Student::query()->when($this->search, function ($query, $search){
            $query->whereAny(['id', 'nik', 'name'], 'like', '%'.$search.'%');
        })->when($this->period, function ($query){
            $query->where('period_id', '=', $this->period);
        })->when($this->domicile, function ($q){
            $q->where('domicile', '=', $this->domicile);
        })->with(['guardian', 'diniyah', 'formal', 'region', 'period'])->paginate(12);

        return view('livewire.register-management.student.index', [
            'students' => $students
        ]);
    }

    public function updating($key): void
    {
        if ($key === 'search' || $key === 'period' || $key === 'domicile') {
            $this->resetPage();
        }
    }
}
