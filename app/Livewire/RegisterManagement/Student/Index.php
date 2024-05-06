<?php

namespace App\Livewire\RegisterManagement\Student;

use App\Models\RegisterManagement\Student;
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
        $students = Student::query()->when($this->search, function ($query, $search){
            $query->whereAny(['id', 'nik', 'name'], 'like', '%'.$search.'%');
        })->with(['guardian', 'diniyah', 'formal', 'region'])->paginate(12);

        return view('livewire.register-management.student.index', [
            'students' => $students
        ]);
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
