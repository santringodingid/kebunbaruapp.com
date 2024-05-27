<?php

namespace App\Http\Controllers\LicensingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComebackController extends Controller
{
    public function index()
    {
        return view('pages.licensing-management.comeback');
    }
}
