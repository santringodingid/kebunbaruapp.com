<?php

namespace App\Livewire\AdministrationManagement\StudentImage;

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
        $this->photo->storeAs('public/avatars/students', $name);

        $this->photo = '';
        $this->reset();
        $this->dispatch('success-created', 'Foto santri berhasil diupload');
    }

    public function render()
    {
        return view('livewire.administration-management.student-image.create');
    }

    #[On('reset')]
    public function resetElement()
    {
        $this->photo = '';
        $this->reset();
    }
}
