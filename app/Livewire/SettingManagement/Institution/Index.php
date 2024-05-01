<?php

namespace App\Livewire\SettingManagement\Institution;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public function placeholder(): string
    {
        return <<<'HTML'
        <div>
            <div class="d-flex align-items-center pt-6 text-muted">
                <span>Data sedang dimuat...</span>
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
        HTML;
    }

    #[On('success')]
    public function render(): View
    {
        $institutions = \App\Models\SettingManagement\Institution::get();
        return view('livewire.setting-management.institution.index', [
            'institutions' => $institutions
        ]);
    }
}
