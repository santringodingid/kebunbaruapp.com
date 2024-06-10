<?php

namespace App\Livewire\LicensingManagement\Petition;

use App\Models\LicensingManagement\Petition;
use App\Models\LicensingManagement\Reason;
use App\Models\LicensingManagement\Recapitulation;
use App\Models\RegisterManagement\Registration;
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
    public $domicileStatus;

    public $reason;
    public $note;
    public $health;

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
        $registration = Registration::query()->with(['student' => function ($query) {
            $query->with(['region']);
        }])->find($this->studentId);
        if (!$registration) {
            $this->dispatch('error', 'Data tidak ditemukan. Pastikan ID Santri valid');
            return;
        }

        if (!$registration->student) {
            $this->dispatch('error', 'Hak akses dicegah');
            return;
        }

        if (!$registration->getRawOriginal('domicile_status')) {
            $this->dispatch('error', 'Perizinan hanya untuk domisili P2K');
            return;
        }

        if ($registration->student->getRawOriginal('status') != 1 && $registration->student->getRawOriginal('status') != 3) {
            $this->dispatch('error', 'Status santri tidak aktif');
            return;
        }

        $petition = Petition::query()->where([
            ['registration_id', '=', $registration->id]
        ])->first();
        if ($petition) {
            if ($petition->getRawOriginal('status') == 1 || $petition->getRawOriginal('status') == 2) {
                $this->dispatch('error', 'Santri bersangkutan sedang dalam permohonan lain');
                return;
            }
        }

        $this->mode = false;
        $this->name = $registration->student->name;
        $this->address = $registration->student->region->village.', '.$registration->student->region->city;
        $domicile = $registration->domicile_status;
        $this->domicile = $domicile.', '.$registration->domicile.' - '.$registration->domicile_number;
        $this->diniyah = $registration->grade_of_diniyah.' - '.$registration->diniyah->name;
        $this->formal = $registration->grade_of_formal.' - '.$registration->formal->name;
        $this->domicileStatus = $registration->student->domicile_status;

        $this->dispatch('success', 'Data berhasil ditemukan');
    }
    public function render(): View
    {
        $reasons = Reason::all();
        return view('livewire.licensing-management.petition.create', compact('reasons'));
    }

    /**
     * @throws \Exception
     */
    public function store(): void
    {
        if ($this->reason == '' || $this->note == '' || $this->health == '') {
            $this->dispatch('error', 'Silahkan isi semua kolom');
            return;
        }

        $data = [
            'reason' => $this->reason,
            'note' => $this->note,
            'is_health' => $this->health,
            'created_by' => auth()->user()->id,
        ];

        if ($this->edit) {
            $petition = Petition::query()->find($this->reg);
            if ($petition) {
                foreach ($data as $key => $value) {
                    $petition->$key = $value;
                }
                $petition->save();
            }

            $this->reset();
            $this->dispatch('success-created', 'Satu permohonan berhasil diubah');
            return;
        }

        $hijri = session('hijri');
        $reg = $this->setRegNumber($hijri);

        $data['id'] = $reg[0];
        $data['reg_number'] = $reg[1];
        $data['registration_id'] = $this->studentId;
        $data['created_at_hijri'] = $hijri;
        $data['expired_at'] = Carbon::now()->addDays(3);

        DB::transaction(function () use ($data) {
            Petition::query()->create($data);

            $hijri = session('hijri');
            $explode = explode('-', $hijri);

            Recapitulation::query()->create([
                'id' => $data['id'],
                'gender' => session('gender_access'),
                'period' => $explode[1],
                'status' => 0
            ]);

            $this->reset();
            $this->dispatch('success-created', 'Satu permohonan berhasil dibuat');
        });
    }

    /**
     * @throws \Exception
     */
    public function setRegNumber($hijri): array
    {
        $explode = explode('-', $hijri);
        $prefix = auth()->user()->current_period.'-';
        $number = IdGenerator::generate(['table' => 'petitions', 'length' => 6, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
        $numberExplode = explode('-', $number);

        return [
            $number,
            $numberExplode[1].'/SIP/P2K/'.romawiMonth($explode[1]).'/'.$explode[0],
        ];
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
        $petition = Petition::query()->with(['registration' => function ($query) {
            $query->with(['diniyah', 'formal']);
        }])->with(['student' => function ($query) {
            $query->with(['region']);
        }])->find($id);

        if ($petition?->getRawOriginal('status') != 1) {
            $this->dispatch('error-edit', 'Data tidak ditemukan');
            return;
        }

        $this->mode = false;
        $this->edit = true;
        $this->studentId = $petition->registration_id;
        $this->name = $petition->student->name;
        $this->address = $petition->student->region->village.', '.$petition->student->region->city;
        $domicile = $petition->registration->domicile_status;
        $this->domicile = $domicile.', '.$petition->registration->domicile.' - '.$petition->registration->domicile_number;
        $this->diniyah = $petition->registration->grade_of_diniyah.' - '.$petition->registration->diniyah->name;
        $this->formal = $petition->registration->grade_of_formal.' - '.$petition->registration->formal->name;

        $this->reg = $id;
        $this->reason = $petition->reason;
        $this->note = $petition->note;
        $this->health = $petition->is_health;

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    #[On('destroy')]
    public function destroy($id)
    {
        $petition = Petition::query()->where('status', '<=', 1)->find($id);
        if (!$petition) {
            $this->dispatch('error', 'Data tidak ditemukan');
            return;
        }

        $petition->delete();
        $this->dispatch('success-created', 'Satu permohonan berhasil dihapus');
    }
}
