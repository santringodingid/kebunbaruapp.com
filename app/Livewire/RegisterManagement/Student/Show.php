<?php

namespace App\Livewire\RegisterManagement\Student;

use App\Models\RegisterManagement\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $studentId;

    public function render()
    {
        $student = Student::query()->with([
            'period', 'diniyah', 'formal', 'region', 'guardian'
        ])->find($this->studentId);
        return view('livewire.register-management.student.show', [
            'student' => $student
        ]);
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

    #[On('show_student')]
    public function showStudent($id): void
    {
        $this->studentId = $id;
    }
}
