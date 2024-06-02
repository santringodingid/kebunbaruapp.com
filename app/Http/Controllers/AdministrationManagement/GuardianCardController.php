<?php

namespace App\Http\Controllers\AdministrationManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuardianCardController extends Controller
{
    public function index()
    {
        return view('pages.administration-management.guardian-card');
    }
}
