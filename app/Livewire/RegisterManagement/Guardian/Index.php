<?php

namespace App\Livewire\RegisterManagement\Guardian;

use App\Models\RegisterManagement\Guardian;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;
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

    #[On('success_store')]
    public function render(): View
    {
        $guardians = Guardian::query()->when($this->search, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        })->with('region')->latest()->paginate(12);
        return view('livewire.register-management.guardian.index', [
            'guardians' => $guardians
        ]);
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
