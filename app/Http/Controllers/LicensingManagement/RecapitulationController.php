<?php

namespace App\Http\Controllers\LicensingManagement;

use App\Exports\LicenseExport;
use App\Http\Controllers\Controller;
use App\Models\LicensingManagement\Recapitulation;
use Illuminate\Http\Request;

class RecapitulationController extends Controller
{
    public function index()
    {
        return view('pages.licensing-management.recapitulation');
    }

    public function export()
    {
        return (new LicenseExport())->download('data-perizinan-'.session()->get('hijri').'.xlsx');
    }
}
