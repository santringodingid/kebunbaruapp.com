<?php

namespace App\Livewire\RegisterManagement\Domicile;

use App\Models\Domicile;
use App\Models\RegisterManagement\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    public $domicile;
    public $status;
    public $domicileList;
    use WithPagination;

    public function mount()
    {
        $gender = session()->get('gender_access');
        $this->domicileList = Domicile::query()->where('gender', $gender)->get();
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
    public function render(): View
    {
        $domiciles = Registration::query()->withWhereHas('student', function ($query) {
            $query->where('status', '!=', 0)->when($this->search, function ($query, $search){
                $query->whereAny(['id', 'nik', 'name'], 'like', '%'.$search.'%');
            });
        })->when($this->domicile, function (Builder $query) {
            $query->where('domicile', $this->domicile);
        })->when($this->status, function (Builder $query) {
            $query->where('is_new_domicile', $this->status);
        })->orderBy('updated_at', 'desc')->paginate(12);

        return view('livewire.register-management.domicile.index', [
            'domiciles' => $domiciles
        ]);
    }

    public function updating($key): void
    {
        if ($key === 'search' || $key === 'domicile' || $key === 'status') {
            $this->resetPage();
        }
    }
}
