<?php

namespace App\Livewire\RegisterManagement\Formal;

use App\Models\RegisterManagement\Registration;
use App\Models\SettingManagement\Institution;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    public $institutions;
    public $institution;
    public $status;
    use WithPagination;

    public function mount()
    {
        $gender = session()->get('gender_access');

        $this->institutions = Institution::query()->whereIn('gender_access', [$gender, 2])
            ->where(['status' => 0, 'status_access' => 2])->get();
    }
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

    #[On('success-created')]
    public function render(): View
    {
        $formals = Registration::query()->withWhereHas('student', function ($query) {
            $query->where('status', '!=', 0)->when($this->search, function ($query, $search) {
                $query->whereAny(['id', 'nik', 'name'], 'like', '%' . $search . '%');
            });
        })->when($this->institution, function (Builder $query) {
            $query->where('institution_formal_id', $this->institution);
        })->when($this->status, function (Builder $query) {
            $query->where('is_new_formal', $this->status);
        })->with('formal')->orderBy('updated_at', 'desc')->paginate(12);

        return view('livewire.register-management.formal.index', [
            'formals' => $formals
        ]);
    }

    public function updating($key): void
    {
        if ($key === 'search' || $key === 'institution' || $key === 'status') {
            $this->resetPage();
        }
    }
}
