<?php

namespace App\Livewire\RegisterManagement\Formal;

use App\Models\RegisterManagement\Formal;
use App\Models\RegisterManagement\Registration;
use App\Models\SettingManagement\Institution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $institutions;
    //true check mode | false save mode
    public $mode;
    public $studentId;
    public $name;
    public $address;
    public $domicile;

    public $grade;
    public $institution;
    public $isNew;
    public $note;

    public $gradeOld;
    public $institutionOld;
    public $isNewOld;

    #[On('success-created')]
    public function mount()
    {
        $gender = session()->get('gender_access');

        $this->institutions = Institution::query()->whereIn('gender_access', [$gender, 2])
            ->where(['status' => 0, 'status_access' => 2])->get();
        $this->mode = true;
        $this->studentId = null;
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
        $registration = Registration::query()->find($this->studentId);
        if (!$registration) {
            $this->dispatch('error', 'Data tidak ditemukan. Pastikan ID Santri valid');
        }else{
            $this->mode = false;

            $registration = Registration::query()->with(['student', 'formal'])->find($this->studentId);

            $this->name = $registration->student->name;
            $this->address = $registration->student->region->village.', '.$registration->student->region->city;
            $this->domicile = $registration->student->domicile_status ? 'P2K' : 'LP2K'.', '.$registration->student->domicile.' - '.$registration->student->domicile_number;

            $this->grade = $registration->grade_of_formal;
            $this->institution = $registration->institution_formal_id;
            $this->isNew = $registration->is_new_formal;

            $this->gradeOld = $registration->grade_of_formal;
            $this->institutionOld = $registration->institution_formal_id;
            $this->isNewOld = $registration->is_new_formal;

            $this->dispatch('success', 'Data berhasil ditemukan');
        }
    }

    public function store()
    {
        if ($this->grade == '' || $this->institution == '' || $this->note == '') {
            $this->dispatch('error', 'Pastikan kelas dan keterangan sudah ditentukan');
            return;
        }

        if ($this->grade == $this->gradeOld && $this->institution == $this->institutionOld && $this->isNew == $this->isNewOld){
            $this->dispatch('error', 'Registrasi yang sama sudah terjadi sebelumnya');
            return;
        }

        DB::transaction(function (){
            $hijri = hijri();

            Formal::query()->create([
                'period_id' => Auth::user()->current_period,
                'student_id' => $this->studentId,
                'grade' => $this->grade,
                'institution_id' => $this->institution,
                'is_new' => $this->isNew,
                'note' => $this->note,
                'created_at_hijri' => $hijri
            ]);

            Registration::query()->where('id', $this->studentId)->update([
                'grade_of_formal' => $this->grade,
                'institution_formal_id' => $this->institution,
                'is_new_formal' => $this->isNew,
            ]);

            $this->mode = true;
            $this->resetElement();
            $this->dispatch('success-created', 'Success');
        });
    }

    public function render()
    {
        return view('livewire.register-management.formal.create');
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

    #[On('add')]
    public function add($id): void
    {
        $this->studentId = $id;
        $this->check();
    }
}
