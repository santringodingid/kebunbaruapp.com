<?php

namespace App\Livewire\AdministrationManagement\GuardianCard;

use App\Models\AdministrationManagement\GuardianCard;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public function render()
    {
        $guardianCards = GuardianCard::query()->withWhereHas('guardian', function ($q) {
            $q->with(['region', 'allStudent' => function ($q) {
                $q->where('status', 1);
            }])->when($this->search, function ($q) {
                $q->whereAny(['id', 'name'], 'LIKE', "%{$this->search}%");
            });
        })->paginate(10);
        return view('livewire.administration-management.guardian-card.index', compact('guardianCards'));
    }
}
