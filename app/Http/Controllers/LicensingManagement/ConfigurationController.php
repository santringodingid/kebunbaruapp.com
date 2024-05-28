<?php

namespace App\Http\Controllers\LicensingManagement;

use App\Http\Controllers\Controller;
use App\Models\LicensingManagement\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigurationController extends Controller
{
    public function index()
    {
        $config = Configuration::query()->where('gender', session('gender_access'))->first();
        return view('pages.licensing-management.configuration', compact('config'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'kamtib' => 'required',
            'health' => 'required',
            'guardian' => 'required',
            'kabid' => 'required',
            'chief' => 'required'
        ]);

        $configByGender = Configuration::query()->where('gender', session('gender_access'))->first();
        $configByGender?->delete();

        $config = [
            'gender' => session('gender_access'),
            'kamtib' => Str::upper($request->kamtib),
            'health' => Str::upper($request->health),
            'guardian' => Str::upper($request->guardian),
            'kabid' => Str::upper($request->kabid),
            'chief' => Str::upper($request->chief)
        ];

        Configuration::query()->create($config);
        return redirect()->route('licensing-management.configuration')->with('error', 'Data tanda tangan berhasil diperbarui');
    }
}
