<?php

namespace App\Livewire\AdministrationManagement\GuardianImage;

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
            'photo' => 'mimes:jpg|max:1024'
        ]);

        $name = $this->photo->getClientOriginalName();
        $oldFile = 'public/avatars/guardians/'.$name;
        if (Storage::exists($oldFile)) {
            Storage::delete($oldFile);
        }
        $this->photo->storeAs('public/avatars/guardians', $name);

        $this->photo = '';
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
        $this->photo = null;
        $this->reset();
    }
}
