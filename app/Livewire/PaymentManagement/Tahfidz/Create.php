<?php

namespace App\Livewire\PaymentManagement\Tahfidz;

use App\Models\PaymentManagement\Account;
use App\Models\PaymentManagement\FareOfTahfidz;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $accounts;

    public $accountId;
    #[Rule(['required'])]
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

        FareOfTahfidz::query()->create([
            'account_id' => $this->accountId,
            'nominal' => (int)$nominal
        ]);
        $this->dispatch('success', 'Akun baru berhasil ditambahkan');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.payment-management.tahfidz.create');
    }
}
