<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Http\Controllers\Controller;
use App\Models\RegisterManagement\Domicile;
use App\Models\RegisterManagement\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DomicileController extends Controller
{
    public function index(): View
    {
        return view('pages.register-management.domicile');
    }
}
