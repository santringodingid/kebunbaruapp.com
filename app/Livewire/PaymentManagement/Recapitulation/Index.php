<?php

namespace App\Livewire\PaymentManagement\Recapitulation;

use App\Models\PaymentManagement\Recapitulation;
use App\Models\PaymentManagement\RecapitulationDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = null;
    public $gender = 2;
    public $hijri;
    public $selectedHijri;

    use WithPagination;

    public function mount()
    {
        $hijri = session('hijri');
        $explode = explode('-', $hijri);

        $this->hijri = $explode[1];
        $this->selectedHijri = $explode[1];
    }

    public function updatedHijri()
    {
        $this->selectedHijri = $this->hijri;
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
    public function render()
    {
        $gender = session('gender_access');
        if ($gender == 0) {
            $this->gender = 0;
        }elseif ($gender == 1) {
            $this->gender = 1;
        }else{
            $this->gender = 2;
        }
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect();
        $results = [];
        $recapitulations = Recapitulation::with('institution:id,name', 'details')->when($this->gender != 2, function ($query){
            $query->where('gender', $this->gender);
        })->when($this->hijri, function ($query){
            $query->where('period', $this->hijri);
        })->orderBy('institution_id', 'asc')->get();
        if ($recapitulations) {
            foreach ($recapitulations as $recapitulation) {
                $details = RecapitulationDetail::query()->where('recapitulation_id', $recapitulation->id)
                    ->join('payment_accounts', 'account_id', '=', 'payment_accounts.id')
                    ->groupBy('account_id')->selectRaw('payment_accounts.name, sum(nominal) as total')
                    ->get();

                $results[] = [
                    'id' => $recapitulation->id,
                    'institution' => $recapitulation?->institution?->name,
                    'total' => $recapitulation?->details->sum('nominal'),
                    'details' => $details
                ];
            }
        }
        return view('livewire.payment-management.recapitulation.index', ['recapitulations' => $results]);
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
