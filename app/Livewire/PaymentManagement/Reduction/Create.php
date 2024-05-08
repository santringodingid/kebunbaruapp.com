<?php

namespace App\Livewire\PaymentManagement\Reduction;

use App\Models\PaymentManagement\Account;
use App\Models\PaymentManagement\Reduction;
use App\Models\PaymentManagement\ReductionDetail;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $accounts;

    #[Rule(['required'])]
    public $name;
    public $checkedAccount;

    #[On('success-created')]
    public function mount()
    {
        $this->accounts = Account::get();
        $this->checkedAccount = [];
    }

    #[On('submit')]
    public function submit()
    {
        $this->validate();
        $reduction = Reduction::create([
            'name' => Str::title($this->name),
        ]);

        if ($this->checkedAccount) {
            foreach ($this->checkedAccount as $account) {
                ReductionDetail::create([
                    'reduction_id' => $reduction->id,
                    'account_id' => $account,
                ]);
            }
        }

        $this->reset();
        $this->dispatch('success-created', 'Data berhasil ditambahkan');
    }

    public function render()
    {
        return view('livewire.payment-management.reduction.create');
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->reset();
        $this->mount();
    }
}
