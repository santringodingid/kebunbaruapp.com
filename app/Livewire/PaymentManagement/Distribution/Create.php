<?php

namespace App\Livewire\PaymentManagement\Distribution;

use App\Models\PaymentManagement\Distribution;
use App\Models\PaymentManagement\Fare;
use App\Models\PaymentManagement\FareDetail;
use App\Models\PaymentManagement\Reduction;
use App\Models\RegisterManagement\Registration;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $reductions;
    //true check mode | false save mode
    public $mode;
    public $studentId;
    public $name;
    public $diniyah;
    public $formal;
    public $address;
    public $domicile;

    public $diniyahId;
    public $grade;
    public $domicileStatus;

    #[Rule(['required'])]
    public $reduction;
    public $note;

    #[On('success-created')]
    public function mount()
    {
        $this->reductions = Reduction::get();
        $this->mode = true;
        $this->studentId = null;
        $this->name = null;
        $this->address = null;
    }

    #[On('submit')]
    public function submit()
    {
        if ($this->mode) {
            $this->check();
        }else{
            $this->store();
        }
    }

    public function check()
    {
        $registration = Registration::query()->with(['student'])->find($this->studentId);
        if (!$registration) {
            $this->dispatch('error', 'Data tidak ditemukan. Pastikan ID Santri valid');
            return;
        }

        if (!$registration->student) {
            $this->dispatch('error', 'Hak akses dicegah');
            return;
        }

        if ($registration->student->getRawOriginal('status') != 1) {
            $this->dispatch('error', 'Status santri tidak aktif');
            return;
        }

        $this->mode = false;
        $this->name = $registration->student->name;
        $this->diniyah = $registration->grade_of_diniyah.' - '.$registration->diniyah->name;
        $this->formal = $registration->grade_of_formal.' - '.$registration->formal->name;
        $this->address = $registration->student->region->village.', '.$registration->student->region->city;
        $status = $registration->domicile_status ? 'P2K' : 'LP2K';
        $this->domicile = $status.', '.$registration->domicile.' - '.$registration->domicile_number;

        $this->diniyahId = $registration->institution_diniyah_id;
        $this->grade = $registration->grade_of_diniyah;
        $this->domicileStatus = $registration->domicile_status;

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    public function store()
    {
        if ($this->reduction == '' || $this->note == '') {
            $this->dispatch('error', 'Pastikan pengurangan dan keterangan sudah ditentukan');
            return;
        }

        //CEK FARE
        $fare = Fare::where([
            ['grade', '=', $this->grade],
            ['institution_id', '=', $this->diniyahId],
            ['domicile_status', '=', $this->domicileStatus]
        ])->first();

        if (!$fare) {
            $this->dispatch('error', 'Tarif untuk kelas dan tingkat tidak ditemukan');
            return;
        }

        $reduction = Reduction::with('details')->find($this->reduction);
        if (!$reduction) {
            $this->dispatch('error', 'Pengurangan tidak valid');
            return;
        }

        DB::Transaction(function () use ($fare, $reduction) {
            $amount = 0;
            $distribution = Distribution::query()->create([
                'registration_id' => $this->studentId,
                'reduction_id' => $this->reduction,
                'notes' => $this->note,
                'amount' => $amount,
            ]);

            foreach ($reduction?->details as $detail) {
                $fareDetail = FareDetail::where([
                    ['fare_id', '=', $fare->id],
                    ['account_id', '=', $detail->account_id],
                ])->first();
                if ($fareDetail) {
                    $amount += $fareDetail?->getRawOriginal('nominal');
                    $distribution->details()->create([
                        'account_id' => $detail->account_id,
                        'nominal' => $fareDetail?->getRawOriginal('nominal')
                    ]);
                }
            }

            Distribution::query()->where('id', '=', $distribution->id)->update([
                'amount' => $amount
            ]);

            $this->mode = true;
            $this->resetElement();
            $this->dispatch('success-created', 'Success');
        });
    }

    public function render()
    {
        return view('livewire.payment-management.distribution.create');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->reset();
        $this->mode = true;
    }
}
