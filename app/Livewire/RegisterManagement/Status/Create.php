<?php

namespace App\Livewire\RegisterManagement\Status;

use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Status;
use App\Models\RegisterManagement\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    //true check mode | false save mode
    public $mode;
    public $studentId;
    public $name;
    public $address;
    public $domicile;
    public $diniyah;
    public $formal;
    public $domicileStatus;

    public $status;
    public $note;
    public $period;
    public $statusOld;

    #[On('success-created')]
    public function mount()
    {
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
            $this->diniyah = $registration->grade_of_diniyah.' - '.$registration->diniyah->name;
            $this->formal = $registration->grade_of_formal.' - '.$registration->formal->name;
            $this->domicileStatus = $registration->student->domicile_status;

            $this->status = $registration->student->getRawOriginal('status');

            $this->statusOld = $registration->student->getRawOriginal('status');

            $this->dispatch('success', 'Data berhasil ditemukan');
        }
    }

    public function store()
    {
        if ($this->note == '') {
            $this->dispatch('error', 'Pastikan keterangan sudah diisi');
            return;
        }

        if (!$this->domicileStatus && $this->status == 0) {
            $this->dispatch('error', 'Registrasi berhenti untuk santri (mukim) harus melalui prosedur boyong');
            return;
        }

        DB::transaction(function (){
            $hijri = hijri();

            Status::query()->create([
                'period_id' => Auth::user()->current_period,
                'student_id' => $this->studentId,
                'status' => $this->status,
                'note' => $this->note,
                'created_at_hijri' => $hijri
            ]);

            Student::query()->where('id', $this->studentId)->update(['status' => $this->status]);

            $this->mode = true;
            $this->resetElement();
            $this->dispatch('success-created', 'Success');
        });
    }

    public function render()
    {
        return view('livewire.register-management.status.create');
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
