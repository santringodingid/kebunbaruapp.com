<?php

namespace App\Livewire\UserManagement\Permission;

use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public Permission $permission;

    #[Rule(['required', 'string'])]
    public string $name;
    public function render()
    {
        return view('livewire.user-management.permission.create');
    }

    public function store()
    {
        $this->validate();

        $this->permission->name = strtolower($this->name);
        if ($this->permission->isDirty()) {
            $permission = $this->permission->save();
        }else{
            $permission = '';
        }

        // Emit a success event with a message indicating that the permissions have been updated.
        $this->dispatch('success', 'Permission berhasil ditambahkan');

        return $permission;
    }

    #[On('modal.show.permission_name')]
    public function mountPermission($permission_name = ''): void
    {
        if (empty($permission_name)) {
            // Create new
            $this->permission = new Permission;
            $this->name = '';
            return;
        }

        // Get the role by name.
        $permission = Permission::where('name', $permission_name)->first();
        if (is_null($permission)) {
            $this->dispatch('error', 'The selected permission [' . $permission_name . '] is not found');
            return;
        }

        $this->permission = $permission;

        // Set the name and checked permissions properties to the role's values.
        $this->name = $this->permission->name;
    }

    #[On('delete_permission')]
    public function delete($name)
    {
        $permission = Permission::where('name', $name)->first();

        if (!is_null($permission)) {
            $permission->delete();
        }

        $this->dispatch('success', 'Permission deleted');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
