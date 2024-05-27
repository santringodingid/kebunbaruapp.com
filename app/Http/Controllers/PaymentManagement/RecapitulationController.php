<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Http\Controllers\Controller;
use App\Models\PaymentManagement\Recapitulation;
use App\Models\PaymentManagement\RecapitulationDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RecapitulationController extends Controller
{
    public int $gender = 2;
    public string $genderName = '';
    public function index()
    {
        return view('pages.payment-management.recapitulation');
    }

    public function export()
    {
        $hijri = \request()->post('hijri');

        $gender = session('gender_access');
        if ($gender == 0) {
            $this->gender = 0;
            $this->genderName = 'BAGIAN PUTRA';
        }elseif ($gender == 1) {
            $this->gender = 1;
            $this->genderName = 'BAGIAN PUTRI';
        }else{
            $this->gender = 2;
            $this->genderName = '';
        }

        $results = [];
        $recapitulations = Recapitulation::with('institution:id,name,shortname', 'details')->when($this->gender != 2, function ($query){
            $query->where('gender', $this->gender);
        })->when($hijri, function ($query, $hijri){
            $query->where('period', $hijri);
        })->orderBy('institution_id', 'asc')->get();
        if ($recapitulations) {
            foreach ($recapitulations as $recapitulation) {
                $details = RecapitulationDetail::query()->where('recapitulation_id', $recapitulation->id)
                    ->join('payment_accounts', 'account_id', '=', 'payment_accounts.id')
                    ->groupBy('account_id')->selectRaw('payment_accounts.name, sum(nominal) as total')
                    ->get();

                $results[] = [
                    'id' => $recapitulation->id,
                    'institution' => $recapitulation?->institution?->shortname,
                    'total' => $recapitulation?->details->sum('nominal'),
                    'details' => $details
                ];
            }
        }

        $pdf = Pdf::loadView('exports.payemnts.recapitulation', [
            'month' => hijriMonth($hijri),
            'gender' => $this->genderName,
            'results' => $results,
            'user' => Auth::user()->name
        ]);

        return $pdf->download('rekapitulasi-tanggal-'.session('hijri').'.pdf');
    }
}
