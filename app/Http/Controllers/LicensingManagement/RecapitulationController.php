<?php

namespace App\Http\Controllers\LicensingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecapitulationController extends Controller
{
    public function index()
    {
        return view('pages.licensing-management.recapitulation');
    }
}
