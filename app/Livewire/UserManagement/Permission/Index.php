<?php

namespace App\Livewire\UserManagement\Permission;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    #[On('success')]
    public function updateList($permission)
    {

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

    public function render(): View
    {
        $permissions = Permission::query()->with('roles')->get();
        return view('livewire.user-management.permission.index', compact('permissions'));
    }
}
