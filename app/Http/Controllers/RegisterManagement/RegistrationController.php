<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Exports\RegistrationExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('pages.register-management.registration');
    }

    public function export()
    {
        return (new RegistrationExport)->download('registration.xlsx');
    }
}
