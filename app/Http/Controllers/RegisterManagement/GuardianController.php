<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Exports\GuardianExport;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    public function index(): View
    {
        return view('pages.register-management.guardian');
    }

    public function export()
    {
        return (new GuardianExport())->download('data-wali-'.session()->get('hijri').'.xlsx');
    }
}
