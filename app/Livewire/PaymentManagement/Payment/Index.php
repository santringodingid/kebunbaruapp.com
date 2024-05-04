<?php

namespace App\Livewire\PaymentManagement\Payment;

use App\Models\PaymentManagement\Payment;
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
        $payments = Payment::with(['registrationHasOne', 'student' => function ($query) {
            $query->where('gender', '=', session()->get('gender_access'));
        }])->latest()->paginate(12);

        return view('livewire.payment-management.payment.index', compact('payments'));
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
