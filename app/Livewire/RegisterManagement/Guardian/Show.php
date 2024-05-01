<?php

namespace App\Livewire\RegisterManagement\Guardian;

use App\Models\RegisterManagement\Guardian;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $guardianId;
    public function render()
    {
        $guardian = Guardian::query()->with(['region', 'students'])->find($this->guardianId);

        return view('livewire.register-management.guardian.show', ['guardian' => $guardian]);
    }

    #[On('show_guardian')]
    public function showGuardian($id): void
    {
        $this->guardianId = $id;
    }
}
