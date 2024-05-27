<?php

namespace App\Livewire\LicensingManagement\Reason;

use App\Models\LicensingManagement\Reason;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.licensing-management.reason.create');
    }

    #[On('store')]
    public function store()
    {
        if ($this->name != ''){
            Reason::query()->create(['name' => Str::title($this->name)]);
            $this->dispatch('success-created', 'Alasan berhasil ditambahkan');
            $this->reset();
            return;
        }
    }
}
