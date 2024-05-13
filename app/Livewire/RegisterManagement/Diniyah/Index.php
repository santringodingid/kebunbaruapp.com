<?php

namespace App\Livewire\RegisterManagement\Diniyah;

use App\Models\RegisterManagement\Registration;
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
        $diniyahs = Registration::query()->withWhereHas('student', function ($query) {
            $query->where('status', '!=', 0)->when($this->search, function ($query, $search) {
                $query->whereAny(['id', 'nik', 'name'], 'like', '%' . $search . '%');
            });
        })->with('diniyah')->orderBy('updated_at', 'desc')->paginate(12);

        return view('livewire.register-management.diniyah.index', [
            'diniyahs' => $diniyahs
        ]);
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
