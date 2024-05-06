<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Exports\FareExport;
use App\Http\Controllers\Controller;
use App\Models\PaymentManagement\Account;
use App\Models\PaymentManagement\Fare;
use App\Models\PaymentManagement\FareDetail;
use App\Models\PaymentManagement\FareOfInfaq;
use App\Models\PaymentManagement\FareOfPesantren;
use App\Models\PaymentManagement\FareOfSchool;
use App\Models\SettingManagement\Institution;
use Illuminate\Http\Request;

class FareController extends Controller
{
    public function index()
    {
        return view('pages.payment-management.fares.fare');
    }

    public function create()
    {
        $infaqFare = FareOfInfaq::where('domicile_status', 0)->get();
        $schoolFare = FareOfSchool::all();
        $pesantrenFare = FareOfPesantren::all();

        $diniyahs = Institution::query()->where(['status' => 0, 'status_access' => 1])->get();
        $accounts = Account::query()->get();
        return view('pages.payment-management.fares.create', compact(
            'diniyahs', 'accounts', 'infaqFare', 'schoolFare', 'pesantrenFare'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade' => 'required',
            'institution' => 'required',
        ]);

        $gradeCopy = $request->gradeCopy;
        $institutionCopy = $request->institutionCopy;

        if (!empty($gradeCopy) && !empty($institutionCopy)) {

            $fareCopy = Fare::with('details')->where([
                ['grade', '=', request('grade')],
                ['institution_id', '=', request('institution')],
            ])->get();

            foreach ($fareCopy as $f) {
                $newFare = Fare::create([
                    'grade' => request('gradeCopy'),
                    'institution_id' => request('institutionCopy'),
                    'domicile_status' => $f->domicile_status,
                    'amount' => $f->getRawOriginal('amount')
                ]);

                foreach ($f->details as $detail) {
                    FareDetail::create([
                        'fare_id' => $newFare->id,
                        'account_id' => $detail->account_id,
                        'note' => $detail->nominal,
                    ]);
                }
            }

            return redirect()->back(201)->with(['success' => 'Tarif berhasil disalin']);
        }

        $nominalSchool = $request->school;
        $nominalInfaq = $request->infaq;
        $nominalPesantren = $request->pesantren;

        //THE FIRST FOR P2K
        $fare = Fare::create([
            'grade' => $request->grade,
            'institution_id' => $request->institution,
            'domicile_status' => 1,
        ]);
        $fareId = $fare->id;

        foreach ($nominalSchool as $key => $nominal) {
            $nominal = preg_replace('/[^0-9]/', '', $nominal);
            if (!empty($nominal)) {
                FareDetail::create([
                    'fare_id' => $fareId,
                    'account_id' => $key,
                    'nominal' => $nominal
                ]);
            }
        }

        $getInfaq = FareOfInfaq::where('domicile_status', '=', 1)->get();
        foreach ($getInfaq as $item) {
            FareDetail::create([
                'fare_id' => $fareId,
                'account_id' => $item->account_id,
                'nominal' => $item->getRawOriginal('nominal')
            ]);
        }

        foreach ($nominalPesantren as $key => $nominal) {
            $nominal = preg_replace('/[^0-9]/', '', $nominal);
            FareDetail::create([
                'fare_id' => $fareId,
                'account_id' => $key,
                'nominal' => $nominal
            ]);
        }

        $sumFare = FareDetail::where('fare_id', $fareId)->sum('nominal');
        Fare::where('id', $fareId)->update(['amount' => $sumFare]);

        //THE SECOND FOR LP2K
        $fare = Fare::create([
            'grade' => $request->grade,
            'institution_id' => $request->institution,
            'domicile_status' => 0,
        ]);
        $fareId = $fare->id;

        foreach ($nominalSchool as $key => $nominal) {
            $nominal = preg_replace('/[^0-9]/', '', $nominal);
            if (!empty($nominal)) {
                FareDetail::create([
                    'fare_id' => $fareId,
                    'account_id' => $key,
                    'nominal' => $nominal
                ]);
            }
        }

        foreach ($nominalInfaq as $key => $item) {
            $nominal = preg_replace('/[^0-9]/', '', $item);
            if (!empty($nominal)) {
                FareDetail::create([
                    'fare_id' => $fareId,
                    'account_id' => $key,
                    'nominal' => $nominal
                ]);
            }
        }

        $sumFare = FareDetail::where('fare_id', $fareId)->sum('nominal');
        Fare::where('id', $fareId)->update(['amount' => $sumFare]);

        return redirect()->back(201)->with(['success' => 'Tarif berhasil ditambahkan']);
    }

    public function export()
    {
        return (new FareExport())->download('list-tarif.xlsx');
    }
}
