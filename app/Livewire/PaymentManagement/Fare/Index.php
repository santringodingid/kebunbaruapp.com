<?php

namespace App\Livewire\PaymentManagement\Fare;

use App\Models\PaymentManagement\Fare;
use App\Models\PaymentManagement\FareOfTahfidz;
use App\Models\SettingManagement\Institution;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $diniyahs;
    public $grade;
    public $institution;
    use WithPagination;

    public function mount()
    {
        $this->diniyahs = Institution::query()->where(['status' => 0, 'status_access' => 1])->get();
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

    #[On('success')]
    public function render(): View
    {
        $fares = Fare::with('institution')->when($this->grade, function ($query){
            $query->where('grade', $this->grade);
        })->when($this->institution, function ($query){
            $query->where('institution_id', $this->institution);
        })->orderBy('institution_id', 'asc')->paginate(12);
        return view('livewire.payment-management.fare.index', compact('fares'));
    }

    public function updating($key): void
    {
        if ($key === 'grade' || $key === 'institution') {
            $this->resetPage();
        }
    }
}
