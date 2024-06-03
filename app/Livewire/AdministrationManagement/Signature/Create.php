<?php

namespace App\Livewire\AdministrationManagement\Signature;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $photos = [];

    public function submit()
    {
        $this->validate([
            'photos.*' => 'mimes:png|max:1024'
        ]);

        foreach ($this->photos as $photo) {
            $name = $photo->getClientOriginalName();
            $photo->storeAs('public/avatars/students', $name);
        }

        $this->photos = null;
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
        $this->photos = null;
        $this->reset();
    }
}
