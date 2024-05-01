<?php

namespace App\Livewire\UserManagement\Role;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public array|Collection $roles;

    public function render(): View
    {
        $this->roles = Role::with('permissions')->get();
        return view('livewire.user-management.role.index');
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div>
            <div class="d-flex align-items-center py-6 text-muted">
                <span>Data sedang dimuat...</span>
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
        HTML;
    }

    #[On('success')]
    public function updateRoleList(): void
    {
        $this->roles = Role::with('permissions')->get();
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
