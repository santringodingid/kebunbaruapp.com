<?php

namespace App\Livewire\LicensingManagement\Petition;

use App\Models\LicensingManagement\Petition;
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
        $petitions = Petition::query()->withWhereHas('student', function ($query) {
            $query->when($this->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })->withWhereHas('registration')->orderBy('created_at', 'desc')->paginate(12);

        return view('livewire.licensing-management.petition.index', compact('petitions'));
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
