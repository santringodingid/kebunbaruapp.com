<?php

namespace App\Livewire\PaymentManagement\Account;

use App\Models\PaymentManagement\Account;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule(['required'])]
    public string $name = '';

    public function store()
    {
        $this->validate();

        Account::query()->create([
            'name' => ucwords($this->name)
        ]);

        $this->reset();
        $this->dispatch('success', __('Akun baru berhasil ditambahkan'));
    }

    public function render(): View
    {
        return view('livewire.payment-management.account.create');
    }
}
