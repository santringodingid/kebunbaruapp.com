<?php

namespace App\Livewire\LicensingManagement\License;

use App\Models\LicensingManagement\License;
use App\Models\LicensingManagement\Petition;
use App\Models\LicensingManagement\Reason;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $mode;
    public $edit;
    public $reg;
    public $studentId;
    public $name;
    public $address;
    public $domicile;
    public $diniyah;
    public $formal;

    public $reason;
    public $note;
    public $health;

    public $startAt;
    public $endAt;

    #[On('success-created')]
    public function mount(): void
    {
        $this->mode = true;
        $this->edit = false;
        $this->reg = '';
        $this->studentId = '';
        $this->reason = '';
        $this->note = '';
        $this->health = '';
        $this->startAt = '';
        $this->endAt = '';
    }

    #[On('submit')]
    public function submit(): void
    {
        if ($this->mode) {
            $this->check();
        }else{
            $this->store();
        }
    }

    public function check(): void
    {
        $petition = Petition::query()->find($this->reg);

        if (!$petition) {
            $this->dispatch('error', 'Data tidak ditemukan. Pastikan No. Reg. valid');
            return;
        }

        if ($petition->getRawOriginal('status') != 1) {
            $this->dispatch('error', 'Permohonan tidak valid');
            return;
        }

        $this->setData($this->reg);

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    public function setData($reg): void
    {
        $petition = Petition::query()->with('registration', function ($query){
            $query->with('diniyah', 'formal');
        })->with('student', function ($query){
            $query->with('region');
        })->find($reg);

        $this->mode = false;
        $this->name = $petition->student->name;
        $this->studentId = $petition->student->id;
        $this->address = $petition->student->region->village.', '.$petition->student->region->city;
        $domicile = $petition->registration->domicile_status;
        $this->domicile = $domicile.', '.$petition->registration->domicile.' - '.$petition->registration->domicile_number;
        $this->diniyah = $petition->registration->grade_of_diniyah.' - '.$petition->registration->diniyah->name;
        $this->formal = $petition->registration->grade_of_formal.' - '.$petition->registration->formal->name;

        $this->reason = $petition->reason;
        $this->note = $petition->note;
    }
    public function render(): View
    {
        $reasons = Reason::all();
        return view('livewire.licensing-management.license.create', compact('reasons'));
    }

    /**
     * @throws \Exception
     */
    public function store(): void
    {
        if ($this->startAt == '' || $this->startAt == '__-__-____ __:__:__') {
            $this->dispatch('error', 'Kolom tanggal berlaku tidak boleh kosong');
            return;
        }

        if ($this->endAt == '' || $this->endAt == '__-__-____ __:__:__') {
            $this->dispatch('error', 'Kolom tanggal akhir tidak boleh kosong');
            return;
        }

        $explodeStartAt = explode(' ', $this->startAt);
        $explodeEndAt = explode(' ', $this->endAt);

        $startAtHijri = getHijri(date('Y-m-d', strtotime($explodeStartAt[0])));
        $endAtHijri = getHijri(date('Y-m-d', strtotime($explodeEndAt[0])));

        $data = [
            'start_at' => date('Y-m-d H:i:s', strtotime($this->startAt)),
            'end_at' => date('Y-m-d H:i:s', strtotime($this->endAt)),
            'start_at_hijri' => $startAtHijri,
            'end_at_hijri' => $endAtHijri,
            'created_by' => auth()->user()->id,
        ];

        DB::transaction(function () use ($data) {
            if ($this->edit) {
                $license = License::query()->find($this->reg);
                if ($license) {
                    foreach ($data as $key => $value) {
                        $license->$key = $value;
                    }
                    $license->save();
                }

                $this->reset();
                $this->dispatch('success-created', 'Satu permohonan berhasil diubah');
                return;
            }

            $data['id'] = $this->reg;

            License::query()->create($data);

            //SET PETITION TO ONGOING
            Petition::query()->find($this->reg)->update(['status' => 2]);

            $this->reset();
            $this->dispatch('success-created', 'Satu surat izin berhasil dibuat');
        });
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->reset();
        $this->mode = true;
        $this->edit = false;
    }

    #[On('edit')]
    public function edit($id)
    {
        $license = License::query()->find($id);

        if (!$license || $license->getRawOriginal('status') != 0) {
            $this->dispatch('error-edit', 'Data tidak ditemukan');
            return;
        }

        $this->edit = true;
        $this->setData($id);
        $this->reg = $id;
        $this->startAt = $license->start_at->format('d-m-Y H:i:s');
        $this->endAt = $license->end_at->format('d-m-Y H:i:s');

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
