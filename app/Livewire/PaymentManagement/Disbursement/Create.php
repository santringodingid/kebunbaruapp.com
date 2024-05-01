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

    public $accountId;
    #[Rule(['required'])]
    public $gender;
    public $institutionId;

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

        $disbursement = AccountDisbursement::query()->where([
            ['account_id', '=', $this->accountId],
            ['gender', '=', $this->gender]
        ])->first();

        if ($disbursement) {
            $disbursement->account_id = $this->accountId;
            $disbursement->institution_id = $this->institutionId;
            $disbursement->gender = $this->gender;

            $disbursement->save();
            $this->dispatch('success', 'Akun baru berhasil diupdate');
        }else{
            AccountDisbursement::query()->create([
                'account_id' => $this->accountId,
                'institution_id' => $this->institutionId,
                'gender' => $this->gender
            ]);
            $this->dispatch('success', 'Akun baru berhasil ditambahkan');
        }

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.payment-management.disbursement.create');
    }
}
