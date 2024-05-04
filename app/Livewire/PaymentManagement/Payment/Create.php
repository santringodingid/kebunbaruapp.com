<?php

namespace App\Livewire\PaymentManagement\Payment;

use App\Models\PaymentManagement\Fare;
use App\Models\PaymentManagement\FareDetail;
use App\Models\PaymentManagement\FareOfRegistration;
use App\Models\PaymentManagement\FareOfTahfidz;
use App\Models\PaymentManagement\Payment;
use App\Models\PaymentManagement\PaymentDetail;
use App\Models\RegisterManagement\Registration;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    //true check mode | false save mode
    public $mode;
    public $selectedOption;
    public $studentId;
    public $institutionId;
    public $name;
    public $address;
    public $domicile;
    public $diniyah;
    public $formal;
    public $domicileStatus;

    public $status;
    public $note;
    public $period;

    public $fareId;

    public $fare = 0;
    public $tahfidz = 0;
    public $registration = 0;

    public $accountRegistrationP2k;
    public $nominalRegistrationP2k = 0;
    public $accountRegistrationLp2k;
    public $nominalRegistrationLp2k = 0;

    public $accountTahfidz;
    public $nominalTahfidz = 0;
    public $textTahfidz = '';
    public $textRegistration;

    public $amountFare = 0;

    public $optionOne;
    public $optionTwo;
    public $optionThree;

    #[On('success-created')]
    public function mount()
    {
        $this->mode = true;
        $this->selectedOption = 0;
        $this->studentId = null;
        $this->institutionId = null;
        $this->name = null;
        $this->address = null;
        $this->domicile = null;
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

        if ($registration->student->getRawOriginal('status') != 1) {
            $this->dispatch('error', 'Status santri tidak aktif');
            return;
        }

        if ($registration->student->gender != session('gender_access')) {
            $this->dispatch('error', 'Aksesmu dicegah...');
            return;
        }

        $payment = Payment::where('registration_id', $this->studentId)->latest()->first();
        if ($payment?->is_paid) {
            $this->dispatch('error', 'Pembayaran sudah lunas sebelumnya');
            return;
        }

        $gradeDiniyah = $registration->grade_of_diniyah;
        $institutionDiniyah = $registration->institution_diniyah_id;
        $isNewDiniyah = $registration->is_new_diniyah;
        $domicileStatus = $registration->domicile_status;
        if ($domicileStatus) {
            $isNewDomicile = $registration->is_new_domicile;
        }else{
            $isNewDomicile = false;
        }
        $this->institutionId = $registration->institution_diniyah_id;

        //CEK FARE
        $fare = Fare::where([
            ['grade', '=', $gradeDiniyah],
            ['institution_id', '=', $institutionDiniyah],
            ['domicile_status', '=', $domicileStatus]
        ])->first();

        if (!$fare) {
            $this->dispatch('error', 'Tarif untuk kelas dan tingkat tidak ditemukan');
            return;
        }
        //SET FARE ID
        $this->fareId = $fare->id;
        $this->amountFare = $fare->getRawOriginal('amount');
        if ($registration->domicile == 'Khusus Tahfidz al-Qur\'an') {
            $fareTahfidz = FareOfTahfidz::first();
            $this->tahfidz = $fareTahfidz->getRawOriginal('nominal');
            $this->accountTahfidz = $fareTahfidz->account_id;
            $this->nominalTahfidz = $fareTahfidz->getRawOriginal('nominal');
            $this->textTahfidz = ' dan Tahfidz Al-Qur\'an';
            $this->amountFare = $fare->getRawOriginal('amount') + $fareTahfidz->getRawOriginal('nominal');
        }

        if (!$payment) {
            $fareRegistrationP2k = FareOfRegistration::where('domicile_status', '=', 1)->first() ?? 0;
            $fareRegistrationLp2k = FareOfRegistration::where('domicile_status', '=', 0)->first() ?? 0;
            if ($isNewDiniyah && $isNewDomicile) {
                $this->registration = $fareRegistrationP2k->getRawOriginal('nominal') + $fareRegistrationLp2k->getRawOriginal('nominal');
                $this->textRegistration = 'Pangkal Masuk Pesantren dan Madrasah';
                $this->accountRegistrationP2k = $fareRegistrationP2k->account_id;
                $this->nominalRegistrationP2k = $fareRegistrationP2k->getRawOriginal('nominal');
                $this->accountRegistrationLp2k = $fareRegistrationLp2k->account_id;
                $this->nominalRegistrationLp2k = $fareRegistrationLp2k->getRawOriginal('nominal');
            }elseif ($isNewDomicile) {
                $this->registration = $fareRegistrationP2k->getRawOriginal('nominal');
                $this->textRegistration = 'Pangkal Masuk Pesantren';
                $this->accountRegistrationP2k = $fareRegistrationP2k->account_id;
                $this->nominalRegistrationP2k = $fareRegistrationP2k->getRawOriginal('nominal');
            }elseif ($isNewDiniyah) {
                $this->registration = $fareRegistrationLp2k->getRawOriginal('nominal');
                $this->textRegistration = 'Pangkal Masuk Madrasah';
                $this->accountRegistrationLp2k = $fareRegistrationLp2k->account_id;
                $this->nominalRegistrationLp2k = $fareRegistrationLp2k->getRawOriginal('nominal');
            }else{
                $this->registration = 0;
                $this->textRegistration = '';
            }

            if ($this->registration <= 0) {
                $this->optionOne = [
                    'status' => true,
                    'amount' => $fare->getRawOriginal('amount') + $this->tahfidz,
                    'text' => 'Biaya Tahunan'.$this->textTahfidz.' 100%',
                    'payment' => 0,
                    'paid' => 1
                ];

                $this->optionTwo = [
                    'status' => true,
                    'amount' => ($fare->getRawOriginal('amount') + $this->tahfidz) / 2,
                    'text' => 'Biaya Tahunan'.$this->textTahfidz.' 50% (Tahap 1)',
                    'payment' => 0,
                    'paid' => 0
                ];

                $this->optionThree = [
                    'status' => false,
                    'amount' => 0,
                    'text' => '',
                    'payment' => 0,
                    'paid' => 0
                ];
            }else {
                $this->optionOne = [
                    'status' => true,
                    'amount' => ($fare->getRawOriginal('amount') + $this->tahfidz) + $this->registration,
                    'text' => $this->textRegistration.' + Biaya Tahunan'.$this->textTahfidz.' 100%',
                    'payment' => 0,
                    'paid' => 1
                ];

                $this->optionTwo = [
                    'status' => true,
                    'amount' => (($fare->getRawOriginal('amount') + $this->tahfidz) / 2) + $this->registration,
                    'text' => $this->textRegistration.' + Biaya Tahunan'.$this->textTahfidz.' 50% (Tahap 1)',
                    'payment' => 0,
                    'paid' => 0
                ];

                $this->optionThree = [
                    'status' => true,
                    'amount' => $this->registration,
                    'text' => $this->textRegistration,
                    'payment' => 0,
                    'paid' => 0
                ];
            }

        }else{
            //JIKA PEMBAYARAN SEBELUMNYA FARE NOL BERARTI HANYA BAYAR PENDAFTARAN
            if ($payment->fare <= 0) {
                $this->optionOne = [
                    'status' => true,
                    'amount' => $fare->getRawOriginal('amount') + $this->tahfidz,
                    'text' => 'Biaya Tahunan'.$this->textTahfidz.' 100%',
                    'payment' => 0,
                    'paid' => 1
                ];

                $this->optionTwo = [
                    'status' => true,
                    'amount' => ($fare->getRawOriginal('amount') + $this->tahfidz) / 2,
                    'text' => 'Biaya Tahunan'.$this->textTahfidz.' 50% (Tahap 1)',
                    'payment' => 0,
                    'paid' => 0
                ];

            }else{
                $this->optionOne = [
                    'status' => false,
                    'amount' => 0,
                    'text' => '',
                    'payment' => 0,
                    'paid' => 0
                ];

                $this->optionTwo = [
                    'status' => true,
                    'amount' => ($fare->getRawOriginal('amount') + $this->tahfidz) - $payment->getRawOriginal('amount'),
                    'text' => 'Biaya Tahunan'.$this->textTahfidz.' 50% (Tahap 2)',
                    'payment' => $payment->id,
                    'paid' => 1
                ];

            }
            $this->optionThree = [
                'status' => false,
                'amount' => 0,
                'text' => '',
                'payment' => 0,
                'paid' => 0
            ];
        }

        $this->mode = false;
        $this->name = $registration->student->name;
        $this->address = $registration->student->region->village.', '.$registration->student->region->city;
        $this->domicile = $registration->domicile_status ? 'P2K' : 'LP2K'.', '.$registration->domicile.' - '.$registration->domicile_number;
        $this->diniyah = $registration->grade_of_diniyah.' - '.$registration->diniyah->name;
        $this->formal = $registration->grade_of_formal.' - '.$registration->formal->name;
        $this->domicileStatus = $registration->student->domicile_status;
        $this->status = $registration->student->getRawOriginal('status');

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    public function store(): void
    {
        DB::transaction(function (){
            $id = IdGenerator::generate([
                'table' => 'payments',
                'length' => 14,
                'prefix' => 'INV-'.date('Ymd'),
                'reset_on_prefix_change' => true
            ]);
            //SET PAYMENT
            Payment::create([
                'id' => $id,
                'registration_id' => $this->studentId,
                'institution_id' => $this->institutionId,
                'user_id' => Auth::user()->id,
                'created_at_hijri' => hijri()
            ]);

            //CEK APAKAH ADA BIAYA PENDAFATARAN
            if ($this->nominalRegistrationP2k > 0) {
                PaymentDetail::create([
                    'payment_id' => $id,
                    'account_id' => $this->accountRegistrationP2k,
                    'is_divisible' => 0,
                    'nominal' => $this->nominalRegistrationP2k,
                ]);
            }

            if ($this->nominalRegistrationLp2k > 0) {
                PaymentDetail::create([
                    'payment_id' => $id,
                    'account_id' => $this->accountRegistrationLp2k,
                    'is_divisible' => 0,
                    'nominal' => $this->nominalRegistrationLp2k,
                ]);
            }

            //JIKA BAYAR PENDAFTARAN SAJA
            if ($this->selectedOption == 3) {
                Payment::where('id', $id)->update([
                    'fare' => 0,
                    'registration' => $this->optionThree['amount'],
                    'amount' => $this->optionThree['amount'],
                    'is_paid' => $this->optionThree['paid'],
                    'notes' => $this->optionThree['text']
                ]);
            } elseif ($this->selectedOption == 2) {
                if ($this->nominalTahfidz > 0) {
                    PaymentDetail::create([
                        'payment_id' => $id,
                        'account_id' => $this->accountTahfidz,
                        'is_divisible' => 1,
                        'nominal' => $this->nominalTahfidz / 2
                    ]);
                }
                $details = FareDetail::where('fare_id', $this->fareId)->get();
                $detailData = [];
                foreach ($details as $detail) {
                    $detailData[] = [
                        'payment_id' => $id,
                        'account_id' => $detail->account_id,
                        'is_divisible' => 1,
                        'nominal' => $detail->getRawOriginal('nominal') / 2
                    ];
                }
                PaymentDetail::insert($detailData);
                Payment::where('id', $id)->update([
                    'fare' => $this->amountFare,
                    'registration' => $this->nominalRegistrationP2k + $this->nominalRegistrationLp2k,
                    'amount' => $this->optionTwo['amount'],
                    'is_paid' => $this->optionTwo['paid'],
                    'notes' => $this->optionTwo['text']
                ]);
            } elseif ($this->selectedOption == 1) {
                if ($this->nominalTahfidz > 0) {
                    PaymentDetail::create([
                        'payment_id' => $id,
                        'account_id' => $this->accountTahfidz,
                        'is_divisible' => 1,
                        'nominal' => $this->nominalTahfidz
                    ]);
                }
                $details = FareDetail::where('fare_id', $this->fareId)->get();
                $detailData = [];
                foreach ($details as $detail) {
                    $detailData[] = [
                        'payment_id' => $id,
                        'account_id' => $detail->account_id,
                        'is_divisible' => 1,
                        'nominal' => $detail->getRawOriginal('nominal')
                    ];
                }
                PaymentDetail::insert($detailData);
                Payment::where('id', $id)->update([
                    'fare' => $this->amountFare,
                    'registration' => $this->nominalRegistrationP2k + $this->nominalRegistrationLp2k,
                    'amount' => $this->optionOne['amount'],
                    'is_paid' => $this->optionOne['paid'],
                    'notes' => $this->optionOne['text']
                ]);
            }else{
                $this->dispatch('error', 'Pembayaran gagal dibuat');
                return;
            }

            $this->resetElement();
            $this->dispatch('success-created', $id);
        });

    }

    public function render()
    {
        return view('livewire.payment-management.payment.create');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->optionOne = [
            'status' => false,
            'amount' => 0,
            'text' => '',
            'payment' => 0,
            'paid' => 0
        ];
        $this->optionTwo = [
            'status' => false,
            'amount' => 0,
            'text' => '',
            'payment' => 0,
            'paid' => 0
        ];
        $this->optionThree = [
            'status' => false,
            'amount' => 0,
            'text' => '',
            'payment' => 0,
            'paid' => 0
        ];
        $this->reset();
        $this->mode = true;
    }
}
