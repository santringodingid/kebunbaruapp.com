<?php

namespace App\Livewire\LicensingManagement\Reason;

use App\Models\LicensingManagement\Reason;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    #[On('success-created')]
    public function render()
    {
        $reasons = Reason::all();
        return view('livewire.licensing-management.reason.index', compact('reasons'));
    }
}
