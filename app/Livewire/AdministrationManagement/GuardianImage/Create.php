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

        $this->photos = [];
        $this->dispatch('success-created', 'Foto wali berhasil diupload');
    }

    protected function cleanupOldUploads()
    {

        $storage = Storage::disk('local');

        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            // On busy websites, this cleanup code can run in multiple threads causing part of the output
            // of allFiles() to have already been deleted by another thread.
            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subSeconds(5)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }
    public function render()
    {
        return view('livewire.administration-management.guardian-image.create');
    }

    #[On('reset')]
    public function resetElement()
    {
        $this->photos = [];
    }
}
