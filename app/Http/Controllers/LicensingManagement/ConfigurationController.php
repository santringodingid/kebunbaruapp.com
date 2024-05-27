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

        $id = $request->id;
        $config = [
            'kamtib' => Str::upper($request->kamtib),
            'health' => Str::upper($request->health),
            'guardian' => Str::upper($request->guardian),
            'kabid' => Str::upper($request->kabid),
            'chief' => Str::upper($request->chief)
        ];
        if ($id && $id != 0) {
            Configuration::query()->where('id', $id)->update($config);
            return redirect()->route('licensing-management.configuration')->with('success', 'Data tanda tangan berhasil diubah');
        }

        Configuration::query()->create($config);
        return redirect()->route('licensing-management.configuration')->with('error', 'Data tanda tangan berhasil ditambah');
    }
}
