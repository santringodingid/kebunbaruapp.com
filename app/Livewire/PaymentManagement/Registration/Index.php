<?php

namespace App\Livewire\PaymentManagement\Registration;

use App\Models\PaymentManagement\FareOfRegistration;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
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

    #[On('success')]
    public function render(): View
    {
        $registrations = FareOfRegistration::with('account')->paginate(12);
        return view('livewire.payment-management.registration.index', ['registrations' => $registrations]);
    }
}
