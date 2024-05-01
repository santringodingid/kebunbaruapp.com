<?php

namespace App\Livewire\PaymentManagement\Infaq;

use App\Models\PaymentManagement\Account;
use App\Models\PaymentManagement\FareOfInfaq;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $accounts;

    public $accountId;
    #[Rule(['required'])]
    public $domicileStatus;
    public $nominal;

    #[On('success')]
    public function mount()
    {
        $this->accounts = Account::query()->get();
    }

    public function store()
    {
        $this->validate();

        if ($this->accountId == 0) {
            $this->dispatch('error', 'Pastikan akun sudah dipilih');
            return;
        }

        $nominal = preg_replace('/[^0-9]/', '', $this->nominal);

        FareOfInfaq::query()->create([
            'account_id' => $this->accountId,
            'domicile_status' => $this->domicileStatus,
            'nominal' => (int)$nominal
        ]);
        $this->dispatch('success', 'Akun baru berhasil ditambahkan');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.payment-management.infaq.create');
    }
}
