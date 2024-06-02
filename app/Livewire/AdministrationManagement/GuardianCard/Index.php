<?php

namespace App\Livewire\AdministrationManagement\GuardianCard;

use App\Models\AdministrationManagement\GuardianCard;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $guardianCards = GuardianCard::with(['guardian' => function ($q) {
            $q->with(['region', 'allStudent' => function ($q) {
                $q->where('status', 1);
            }]);
        }])->paginate(10);
        return view('livewire.administration-management.guardian-card.index', compact('guardianCards'));
    }
}
