<?php

namespace App\Livewire\LicensingManagement\Recapitulation;

use App\Models\LicensingManagement\Recapitulation;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    public $status;
    public $gender = 2;
    public $hijri;
    public $selectedHijri;
    public $selectedStatus;

    use WithPagination;

    public function mount()
    {
        $hijri = session('hijri');
        $explode = explode('-', $hijri);

        $this->hijri = $explode[1];
        $this->selectedHijri = $explode[1];
    }

    public function updatedHijri()
    {
        $this->selectedHijri = $this->hijri;
    }

    public function updatedStatus()
    {
        $this->selectedStatus = $this->status;
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

    #[On('success-created')]
    public function render()
    {
        $gender = session('gender_access');
        $this->gender = $gender;

        $licenses = Recapitulation::query()->with('petition', function ($query){
            $query->with(['registration', 'student']);
        })->when($this->gender != 2, function ($query){
            $query->where('gender', $this->gender);
        })->when($this->hijri, function ($query){
            $query->where('period', $this->hijri);
        })->when($this->status != '', function (Builder $query) {
            $query->where('status', $this->status);
        })->orderBy('id', 'desc')->paginate(12);

        return view('livewire.licensing-management.recapitulation.index', compact('licenses'));
    }

    public function search()
    {
        $this->resetPage();
    }
}
