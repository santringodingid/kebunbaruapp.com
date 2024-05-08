<?php

namespace App\Livewire\PaymentManagement\Reduction;

use App\Models\PaymentManagement\Reduction;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
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
        $reductions = Reduction::with('details')->paginate(12);
        return view('livewire.payment-management.reduction.index', compact('reductions'));
    }
}
