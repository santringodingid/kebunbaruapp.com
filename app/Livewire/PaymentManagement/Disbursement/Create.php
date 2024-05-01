<?php

namespace App\Livewire\PaymentManagement\Disbursement;

use App\Models\PaymentManagement\Account;
use App\Models\PaymentManagement\AccountDisbursement;
use App\Models\SettingManagement\Institution;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $institutions;
    public $accounts;

    #[Rule('required')]
    public $accountId;
    public $institutionMale;
    public $institutionFemale;

    #[On('success')]
    public function mount()
    {
        $this->institutions = Institution::query()->where('status_access', 0)->get();
        $this->accounts = Account::query()->get();
    }

    public function store()
    {
        $this->validate();

        if ($this->accountId == 0) {
            $this->dispatch('error', 'Pastikan akun sudah dipilih');
            return;
        }

        AccountDisbursement::where([
            ['account_id', $this->accountId],
            ['gender', 0],
        ])->delete();

        AccountDisbursement::where([
            ['account_id', $this->accountId],
            ['gender', 1],
        ])->delete();

        AccountDisbursement::query()->create([
            'account_id' => $this->accountId,
            'institution_id' => $this->institutionMale,
            'gender' => 0
        ]);

        AccountDisbursement::query()->create([
            'account_id' => $this->accountId,
            'institution_id' => $this->institutionFemale,
            'gender' => 1
        ]);

        $this->dispatch('success', 'Akun baru berhasil ditambahkan');

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.payment-management.disbursement.create');
    }
}
