<?php

namespace App\Livewire\RegisterManagement\Domicile;

use App\Models\Domicile;
use App\Models\RegisterManagement\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $domiciles;
    //true check mode | false save mode
    public $mode;
    public $studentId;
    public $image;
    public $name;
    public $diniyah;
    public $formal;
    public $address;

    public $domicileStatus;
    public $domicile;
    public $domicileNumber;
    public $isNew;
    public $note;

    public $domicileStatusOld;
    public $domicileOld;
    public $domicileNumberOld;
    public $isNewOld;

    #[On('success-created')]
    public function mount()
    {
        $gender = session()->get('gender_access');

        $this->domiciles = Domicile::query()->where('gender', $gender)->get();
        $this->mode = true;
        $this->studentId = null;
        $this->name = null;
        $this->address = null;
        $this->image = '';
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
        $registration = Registration::query()->find($this->studentId);
        if (!$registration) {
            $this->dispatch('error', 'Data tidak ditemukan. Pastikan ID Santri valid');
        }else{
            $this->mode = false;

            $registration = Registration::query()->with(['student', 'diniyah', 'formal'])->find($this->studentId);

            $this->name = $registration->student->name;
            $this->diniyah = $registration->grade_of_diniyah.' - '.$registration->diniyah->name;
            $this->formal = $registration->grade_of_formal.' - '.$registration->formal->name;
            $this->address = $registration->student->region->village.', '.$registration->student->region->city;
            $this->domicileStatus = $registration->getRawOriginal('domicile_status');
            $this->domicile = $registration->domicile;
            $this->domicileNumber = $registration->domicile_number;
            $this->isNew = $registration->is_new_domicile;
            $this->image = $registration?->student?->image_of_profile;

            $this->domicileStatusOld = $registration->getRawOriginal('domicile_status');
            $this->domicileOld = $registration->domicile;
            $this->domicileNumberOld = $registration->domicile_number;
            $this->isNewOld = $registration->is_new_domicile;

            $this->dispatch('success', 'Data berhasil ditemukan');
        }
    }

    public function store()
    {
        if ($this->domicileNumber == '' || $this->domicile == '' || $this->note == '') {
            $this->dispatch('error', 'Pastikan domisili dan keterangan sudah ditentukan');
            return;
        }

        if ($this->domicileStatus == 0 && $this->domicile != 'Rumah Orang Tua') {
            $this->dispatch('error', 'Domisili untuk LP2K tidak valid');
            return;
        }

        if ($this->domicileStatus == 1 && $this->domicile == 'Rumah Orang Tua') {
            $this->dispatch('error', 'Domisili untuk P2K tidak valid');
            return;
        }

        if ($this->domicileStatus == $this->domicileStatusOld && $this->domicile == $this->domicileOld && $this->domicileNumber == $this->domicileNumberOld && $this->isNew == $this->isNewOld){
            $this->dispatch('error', 'Registrasi yang sama sudah terjadi sebelumnya');
            return;
        }

        DB::transaction(function (){
            $hijri = hijri();
            \App\Models\RegisterManagement\Domicile::query()->create([
                'period_id' => Auth::user()->current_period,
                'student_id' => $this->studentId,
                'domicile_status' => $this->domicileStatus,
                'domicile' => $this->domicile,
                'domicile_number' => $this->domicileNumber,
                'is_new' => $this->isNew,
                'note' => Str::ucfirst($this->note),
                'created_at_hijri' => $hijri
            ]);

            Registration::query()->where('id', $this->studentId)->update([
                'domicile_status' => $this->domicileStatus,
                'domicile' => $this->domicile,
                'domicile_number' => $this->domicileNumber,
                'is_new_domicile' => $this->isNew,
            ]);

            $this->resetElement();
            $this->dispatch('success-created', 'Success');
        });
    }

    public function render()
    {
        return view('livewire.register-management.domicile.create');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->mode = true;
        $this->reset();
    }

    #[On('add')]
    public function add($id): void
    {
        $this->studentId = $id;
        $this->check();
    }
}
