<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Http\Controllers\Controller;
use App\Models\PaymentManagement\AccountDisbursement;
use App\Models\PaymentManagement\Payment;
use App\Models\PaymentManagement\Recapitulation;
use App\Models\PaymentManagement\RecapitulationDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecapitulationController extends Controller
{
    public int $gender = 2;
    public string $genderName = '';
    public function index()
    {
        return view('pages.payment-management.recapitulation');
    }

    public function config($hijri)
    {
        DB::transaction(function () use ($hijri) {
            $period = Auth::user()->current_period;
            $gender = session('gender_access');
            //GET PAYMENT
            $payments = Payment::with(['paymentDetails' => function ($query) {
                $query->where('is_reducible', 0);
            }])->where('user_id', Auth::user()->id)->whereRaw("substring(created_at_hijri, 6, 2) = $hijri")->get();

            if ($payments) {
                foreach ($payments as $payment) {
                    foreach ($payment?->paymentDetails as $paymentDetail) {
                        $account = $paymentDetail?->account_id;
                        $disbursement = AccountDisbursement::where([
                            ['account_id', '=', $account],
                            ['gender', '=', $gender]
                        ])->first();
                        if ($disbursement) {
                            $disbursementOfInstitution = $disbursement?->institution_id;
                            if ($disbursementOfInstitution == '' || $disbursementOfInstitution == null) {
                                $institutionId = $payment->institution_id;
                            }else{
                                $institutionId = $disbursementOfInstitution;
                            }

                            //CHECK INSTITUTION IN RECAPITULATION
                            $recapitulation = Recapitulation::query()->where([
                                ['period_id', '=', $period],
                                ['institution_id', '=', $institutionId],
                                ['period', '=', $hijri],
                                ['gender', '=', $gender]
                            ])->first();
                            if (!$recapitulation) {
                                $recapitulation = Recapitulation::query()->create([
                                    'period_id' => $period,
                                    'institution_id' => $institutionId,
                                    'period' => $hijri,
                                    'gender' => $gender
                                ]);
                            }

                            RecapitulationDetail::query()->create([
                                'recapitulation_id' => $recapitulation->id,
                                'payment_id' => $payment->id,
                                'account_id' => $account,
                                'nominal' => $paymentDetail?->getRawOriginal('nominal')
                            ]);
                        }
                    }
                }
            }
        });

        return redirect()->route('payment-management.recapitulation');
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
        $recapitulations = Recapitulation::with('institution:id,name', 'details')->when($this->gender != 2, function ($query){
            $query->where('gender', $this->gender);
        })->where('period', $hijri)->orderBy('institution_id', 'asc')->get();
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

        $pdf = Pdf::loadView('exports.payemnts.recapitulation', [
            'month' => hijriMonth($hijri),
            'gender' => $this->genderName,
            'results' => $results,
            'user' => Auth::user()->name
        ]);

        return $pdf->download('rekapitulasi-tanggal-'.session('hijri').'.pdf');
    }
}
