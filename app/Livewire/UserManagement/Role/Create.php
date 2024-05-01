<?php

namespace App\Livewire\UserManagement\Role;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    #[Rule(['required', 'string'])]
    public $name;
    public $checked_permissions;
    public $check_all;

    public Role $role;
    public Collection $permissions;

    // This function is called when the component receives the `modal.show.role_name` event.
    #[On('modal.show.role_name')]
    public function mountRole($role_name = ''): void
    {
        if (empty($role_name)) {
            // Create new
            $this->role = new Role;
            $this->name = '';
            return;
        }

        // Get the role by name.
        $role = Role::where('name', $role_name)->first();
        if (is_null($role)) {
            $this->dispatch('error', 'The selected role [' . $role_name . '] is not found');
            return;
        }

        $this->role = $role;

        // Set the name and checked permissions properties to the role's values.
        $this->name = $this->role->name;
        $this->checked_permissions = $this->role->permissions->pluck('name');
    }

    // This function is called when the component is mounted.
    public function mount(): void
    {
        // Get all permissions.
        $this->permissions = Permission::all();

        // Set the checked permissions property to an empty array.
        $this->checked_permissions = [];
    }

    // This function renders the component's view.
    public function render(): View
    {
        // Create an array of permissions grouped by ability.
        $permissions_by_group = [];
        foreach ($this->permissions ?? [] as $permission) {
            $ability = Str::after($permission->name, ' ');

            $permissions_by_group[$ability][] = $permission;
        }

        // Return the view with the permissions_by_group variable passed in.
        return view('livewire.user-management.role.create', compact('permissions_by_group'));
    }

    // This function submits the form and updates the role's permissions.
    public function submit(): void
    {
        $this->validate();

        $this->role->name = $this->name;
        if ($this->role->isDirty()) {
            $this->role->save();
        }

        // Sync the role's permissions with the checked permissions property.
        $this->role->syncPermissions($this->checked_permissions);

        // Emit a success event with a message indicating that the permissions have been updated.
        $this->dispatch('success', 'Permissions for ' . ucwords($this->role->name) . ' role updated');
    }

    // This function checks all of the permissions.
    public function checkAll(): void
    {
        // If the check_all property is true, set the checked permissions property to all of the permissions.
        if ($this->check_all) {
            $this->checked_permissions = $this->permissions->pluck('name');
        } else {
            // Otherwise, set the checked permissions property to an empty array.
            $this->checked_permissions = [];
        }
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
