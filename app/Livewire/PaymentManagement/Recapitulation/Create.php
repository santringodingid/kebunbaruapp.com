<?php

namespace App\Livewire\PaymentManagement\Recapitulation;

use App\Models\PaymentManagement\Payment;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.payment-management.recapitulation.create');
    }

    #[On('submit')]
    public function submit(): void
    {
        $payments = Payment::withWhereHas('student', function ($query){
            $query->select('students.id');
        })->where('is_recapped', 0)->update(['is_recapped' => 1]);

        if ($payments > 0) {
            $this->dispatch('success-created', "$payments transaksi berhasil diposting");
        }else{
            $this->dispatch('error', "Tak ada transaksi untuk diposting");
        }
    }
}
