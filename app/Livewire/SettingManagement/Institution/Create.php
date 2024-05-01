<?php

namespace App\Livewire\SettingManagement\Institution;

use App\Models\SettingManagement\Institution;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule(['required'])]
    public string $code = '';
    #[Rule(['required'])]
    public string $name = '';
    #[Rule(['required'])]
    public string $commission = '';
    #[Rule(['required'])]
    public string $gender_access = '';
    #[Rule(['required'])]
    public string $status_access = '';
    #[Rule(['required'])]
    public string $status = '';

    public function store(): void
    {
        $this->validate();

        Institution::query()->create([
            'code' => $this->code,
            'name' => Str::title($this->name),
            'commission' => $this->commission,
            'gender_access' => $this->gender_access,
            'status_access' => $this->status_access,
            'status' => $this->status,
        ]);

        $this->reset();
        $this->dispatch('success', __('Instansi baru berhasil ditambahkan'));
    }

    public function render(): View
    {
        return view('livewire.setting-management.institution.create');
    }
}
