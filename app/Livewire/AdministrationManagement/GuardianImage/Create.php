<?php

namespace App\Livewire\AdministrationManagement\GuardianImage;

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
            'photos.*' => 'mimes:jpg|max:1024'
        ]);

        foreach ($this->photos as $photo) {
            $name = $photo->getClientOriginalName();
            $photo->storeAs('public/avatars/guardians', $name);
        }

        $this->photos = null;
        $this->reset();
        $this->dispatch('success-created', 'Foto wali berhasil diupload');
    }

    public function render()
    {
        return view('livewire.administration-management.guardian-image.create');
    }

    #[On('reset')]
    public function resetElement()
    {
        $this->photos = null;
        $this->reset();
    }
}
