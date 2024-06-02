<?php

namespace App\Livewire\AdministrationManagement\GuardianImage;

use App\Models\RegisterManagement\Guardian;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
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
        $guardians = Guardian::when($this->search, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        })->paginate(12);
        return view('livewire.administration-management.guardian-image.index', compact('guardians'));
    }
}
