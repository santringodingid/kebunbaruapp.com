<?php

namespace App\Http\Controllers\LicensingManagement;

use App\Http\Controllers\Controller;
use App\Models\LicensingManagement\Configuration;
use App\Models\LicensingManagement\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function index()
    {
        return view('pages.licensing-management.petition');
    }

    public function print($id)
    {
        $petition = Petition::query()->with(['student' => function ($query) {
            $query->with('region');
        }])->with('registration', 'user')->where([
            ['id', '=', $id],
            ['status', '=', 1]
        ])->first();

        $config = Configuration::query()->where('gender', session('gender_access'))->first();
        return view('prints.petition', compact('petition', 'config'));
    }
}
