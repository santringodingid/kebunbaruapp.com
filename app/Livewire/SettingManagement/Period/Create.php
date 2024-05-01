<?php

namespace App\Livewire\SettingManagement\Period;

use App\Models\SettingManagement\Period;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule(['required'])]
    public string $diniyah = '';
    #[Rule(['required'])]
    public string $ammiyah = '';

    public function store()
    {
        $this->validate();

        Period::query()->create([
            'diniyah' => $this->diniyah,
            'ammiyah' => $this->ammiyah
        ]);

        $this->reset();
        $this->dispatch('success', __('Period baru berhasil ditambahkan'));
    }

    public function render(): View
    {
        return view('livewire.setting-management.period.create');
    }
}
