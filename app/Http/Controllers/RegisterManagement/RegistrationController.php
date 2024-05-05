<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Exports\RegistrationExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('pages.register-management.registration');
    }

    public function export()
    {
        return (new RegistrationExport)->download('data-registrasi-'.session()->get('hijri').'.xlsx');
    }
}
