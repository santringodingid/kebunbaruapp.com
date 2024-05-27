<?php

namespace App\Livewire\LicensingManagement\Comeback;

use App\Models\LicensingManagement\License;
use App\Models\LicensingManagement\Petition;
use App\Models\LicensingManagement\Reason;
use Carbon\Carbon;
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

    public $switchFinishAt;
    public $finishAt;

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
        $license = License::query()->find($this->reg);

        if (!$license) {
            $this->dispatch('error', 'Data tidak ditemukan. Pastikan No. Reg. valid');
            return;
        }

        if ($license->getRawOriginal('status') != 1) {
            $this->dispatch('error', 'Surat izin tidak aktif');
            return;
        }

        $this->setData($this->reg);

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    public function setData($reg): void
    {
        $license = License::query()->with('petition', function ($query){
            $query->with(['registration', 'student' => function ($query){
                $query->with('region');
            }]);
        })->find($reg);

        $this->mode = false;
        $this->name = $license->petition->student->name;
        $this->studentId = $license->petition->student->id;
        $this->address = $license->petition->student->region->village.', '.$license->petition->student->region->city;
        $domicile = $license->petition->registration->domicile_status ? 'P2K' : 'LP2K';
        $this->domicile = $domicile.', '.$license->petition->registration->domicile.' - '.$license->petition->registration->domicile_number;
        $this->diniyah = $license->petition->registration->grade_of_diniyah.' - '.$license->petition->registration->diniyah->shortname;
        $this->formal = $license->petition->registration->grade_of_formal.' - '.$license->petition->registration->formal->shortname;

        $this->reason = $license->petition->reason;
        $this->note = $license->petition->note;
    }
    public function render(): View
    {
        $reasons = Reason::all();
        return view('livewire.licensing-management.comeback.create', compact('reasons'));
    }

    /**
     * @throws \Exception
     */
    public function store(): void
    {
        if (!$this->switchFinishAt) {
            if ($this->finishAt == '' || $this->finishAt == '__-__-____ __:__:__') {
                $this->dispatch('error', 'Kolom tanggal kembali tidak boleh kosong');
                return;
            }
        }

        if ($this->switchFinishAt) {
            $finishAt = Carbon::now();
        }else{
            $finishAt = date('Y-m-d H:i:s', strtotime($this->finishAt));
        }

        $explode = explode(' ', $finishAt);
        $finishAtHijri = getHijri(date('Y-m-d', strtotime($explode[0])));

        DB::transaction(function () use ($finishAt, $finishAtHijri) {
            $license = License::query()->find($this->reg);
            $endAt = $license->end_at;

            $isLate = $finishAt > $endAt;

            $license->finish_at = $finishAt;
            $license->finish_at_hijri = $finishAtHijri;
            $license->is_late = $isLate;
            $license->finished_by = auth()->user()->id;
            $license->save();

            $this->reset();
            $this->dispatch('success-created', 'Satu izin berhasil diselesaikan');
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

        if (!$license || $license->getRawOriginal('status') != 1) {
            $this->dispatch('error-edit', 'Data tidak ditemukan');
            return;
        }

        $this->edit = true;
        $this->setData($id);
        $this->reg = $id;
        $this->finishAt = $license->finish_at->format('d-m-Y H:i:s');
        $this->switchFinishAt = 0;

        $this->dispatch('success', 'Data berhasil ditemukan');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('add')]
    public function add($id): void
    {
        $this->reg = $id;
        $this->check();
    }
}
