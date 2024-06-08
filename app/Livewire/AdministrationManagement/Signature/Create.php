<?php

namespace App\Livewire\AdministrationManagement\Signature;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $photo;

    public function submit()
    {
        $this->validate([
            'photo' => 'mimes:png|max:1024'
        ]);

        $name = $this->photo->getClientOriginalName();
        $this->photo->storeAs('public/avatars/signatures', $name);

        $this->photo = '';
        $this->reset();
        $this->dispatch('success-created', 'Foto santri berhasil diupload');
    }

    public function render()
    {
        return view('livewire.administration-management.signature.create');
    }

    #[On('reset')]
    public function resetElement()
    {
        $this->photo = '';
        $this->reset();
    }
}
