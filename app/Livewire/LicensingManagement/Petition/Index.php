<?php

namespace App\Livewire\LicensingManagement\Petition;

use App\Models\LicensingManagement\Petition;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    public $status;
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
        })->withWhereHas('registration')->orderBy('created_at', 'desc')->when($this->status != '', function (Builder $query) {
            $query->where('status', $this->status);
        })->paginate(12);

        return view('livewire.licensing-management.petition.index', compact('petitions'));
    }

    public function search()
    {
        $this->resetPage();
    }
}
