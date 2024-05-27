<?php

namespace App\Livewire\LicensingManagement\Recapitulation;

use App\Models\LicensingManagement\Recapitulation;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    public $gender = 2;
    public $hijri;
    public $selectedHijri;

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
        })->orderBy('id', 'desc')->paginate(12);

        return view('livewire.licensing-management.recapitulation.index', compact('licenses'));
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
