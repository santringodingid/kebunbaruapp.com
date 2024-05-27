<?php

namespace App\Livewire\LicensingManagement\License;

use App\Models\LicensingManagement\License;
use App\Models\LicensingManagement\Petition;
use App\Models\LicensingManagement\Recapitulation;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    use WithPagination;
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
    public function render(): View
    {
        $licenses = License::query()->withWhereHas('petition', function ($query){
            $query->withWhereHas('student', function ($query) {
                $query->when($this->search, function ($query, $search) {
                    $query->whereAny(['name', 'id'], 'like', "%$search%");
                });
            })->withWhereHas('registration');
        })->orderBy('start_at', 'desc')->paginate(12);

        return view('livewire.licensing-management.license.index', compact('licenses'));
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }

    #[On('activate')]
    public function activate($id): void
    {
        $license = License::query()->find($id);
        if (!$license) {
            $this->dispatch('error', 'Data tidak ditemukan');
            return;
        }

        $petition = Petition::query()->find($id);
        if (!$petition) {
            $this->dispatch('error', 'Data tidak ditemukan');
            return;
        }

        $license->status = 1;
        $license->save();

        $petition->status = 3;
        $petition->save();

        $recapitulation = Recapitulation::query()->find($id);
        $recapitulation->status = 1;
        $recapitulation->save();

        $this->dispatch('success-created', 'Izin telah diaktifkan');
    }
}
