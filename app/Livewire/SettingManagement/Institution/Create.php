<?php

namespace App\Livewire\SettingManagement\Institution;

use App\Models\SettingManagement\Institution;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $mode = false; //true => update | false => add
    public $id;
    #[Rule(['required'])]
    public string $code = '';
    #[Rule(['required'])]
    public string $name = '';
    #[Rule(['required'])]
    public string $shortName = '';
    #[Rule(['required'])]
    public string $commission = '';
    #[Rule(['required'])]
    public string $gender_access;
    #[Rule(['required'])]
    public string $status_access;
    #[Rule(['required'])]
    public string $status;

    public function store(): void
    {
        $this->validate();
        $data = [
            'code' => $this->code,
            'name' => Str::title($this->name),
            'shortname' => Str::upper($this->shortName),
            'commission' => $this->commission,
            'gender_access' => $this->gender_access,
            'status_access' => $this->status_access,
            'status' => $this->status,
        ];

        if ($this->mode) {
            Institution::where('id', $this->id)->update($data);
            $message = 'Instansi berhasil diubah';
        }else{
            Institution::create($data);
            $message = 'Instansi berhasil ditambah';
        }

        $this->reset();
        $this->dispatch('success', $message);
    }

    #[On('edit_institution')]
    public function edit($id)
    {
        $institution = Institution::find($id);
        if (!$institution) {
            $this->dispatch('error', 'Data tidak valid');
            return;
        }

        $this->mode = true;
        $this->id = $id;
        $this->code = $institution->code;
        $this->name = $institution->name;
        $this->shortName = $institution->shortname;
        $this->commission = $institution->commission;
        $this->gender_access = $institution->getRawOriginal('gender_access');
        $this->status_access = $institution->getRawOriginal('status_access');
        $this->status = $institution->getRawOriginal('status');
    }

    public function render(): View
    {
        return view('livewire.setting-management.institution.create');
    }
}
