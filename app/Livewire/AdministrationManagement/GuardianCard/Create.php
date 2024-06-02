<?php

namespace App\Livewire\AdministrationManagement\GuardianCard;

use App\Models\AdministrationManagement\GuardianCard;
use App\Models\RegisterManagement\Guardian;
use App\Models\RegisterManagement\Student;
use App\Models\Scopes\GenderScope;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $mode;
    public $guardianId;
    public $guardian;

    public function mount()
    {
        $this->mode = true;
        $this->guardianId = '';
        $this->guardian = '';
    }

    #[On('submit')]
    public function submit()
    {
        if ($this->mode) {
            $this->check();
            return;
        }

        $this->store();
    }

    public function check()
    {
        if ($this->guardianId == ''){
            $this->dispatch('error', 'ID Wali harus diisi');
            return;
        }

        $guardianCheck = GuardianCard::where('guardian_id', $this->guardianId)->first();
        if ($guardianCheck) {
            $this->dispatch('error', 'Kartu wali aktif Sudah Ada');
            return;
        }

        $guardianCheck = Guardian::find($this->guardianId);
        if (!$guardianCheck) {
            $this->dispatch('error', 'Data wali tidak ditemukan');
            return;
        }

        if(!file_exists('storage/'.$guardianCheck->image)){
            $this->dispatch('error', 'Foto wali tidak ditemukan');
            return;
        }

        $student = Student::where([
            ['guardian_id', '=', $this->guardianId],
            ['status', '=', 1],
        ])->withoutGlobalScope(GenderScope::class)->get();
        if (!$student){
            $this->dispatch('error', 'Data muwalli tidak ditemukan');
            return;
        }

        foreach ($student as $s){
            if(!file_exists('storage/'.$s->image_of_profile)){
                $this->dispatch('error', 'Foto santri tidak ditemukan');
                return;
            }
        }

        $this->mode = false;

        $this->guardian = Guardian::with(['region', 'allStudent' => function($q){
            $q->where('status', 1);
        }])->find($this->guardianId);

        $this->dispatch('success', 'Data berhasil ditambahkan');
    }

    public function store()
    {
        $id = IdGenerator::generate([
            'table' => 'guardian_cards',
            'length' => 15,
            'prefix' => 'GC-'.date('Ymd')
        ]);
        GuardianCard::query()->create([
            'id' => $id,
            'guardian_id' => $this->guardianId,
            'created_at' => now(),
            'created_by' => auth()->user()->id,
        ]);

        $this->dispatch('success-created', 'Data berhasil ditambahkan');
        $this->resetElemet();
    }
    public function render(): View
    {
        return view('livewire.administration-management.guardian-card.create');
    }

    #[On('reset')]
    public function resetElemet()
    {
        $this->mode = true;
        $this->guardianId = '';
        $this->guardian = '';
    }
}
