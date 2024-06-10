<?php

namespace App\Livewire\RegisterManagement\Registration;

use App\Models\Domicile;
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
    public $domiciles;
    public $domicile;
    public $diniyahs;
    public $diniyah;
    public $ammiyahs;
    public $ammiyah;
    public $status;
    use WithPagination;

    public function mount()
    {
        $gender = session()->get('gender_access');
        $this->domiciles = Domicile::query()->where('gender', $gender)->get();

        $this->diniyahs = Institution::query()->whereIn('gender_access', [$gender, 2])
            ->where(['status' => 0, 'status_access' => 1])->get();

        $this->ammiyahs = Institution::query()->whereIn('gender_access', [$gender, 2])
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
        $statuses = Registration::query()->withWhereHas('student', function ($query) {
            $query->whereAny([
                'id', 'name', 'nik'
            ], 'like', '%'.$this->search.'%')->when($this->status != '', function (Builder $builder) {
                $builder->where('status', $this->status);
            });
        })->when($this->domicile, function (Builder $query) {
            $query->where('domicile', $this->domicile);
        })->when($this->diniyah, function (Builder $query) {
            $query->where('institution_diniyah_id', $this->diniyah);
        })->when($this->ammiyah, function (Builder $query) {
            $query->where('institution_formal_id', $this->ammiyah);
        })->with(['diniyah', 'formal'])->orderBy('updated_at', 'desc')->paginate(12);

        return view('livewire.register-management.registration.index', [
            'statuses' => $statuses
        ]);
    }

    public function search()
    {
        $this->resetPage();
    }
}
