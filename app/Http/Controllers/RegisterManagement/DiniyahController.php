<?php

namespace App\Http\Controllers\RegisterManagement;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DiniyahController extends Controller
{
    public function index(): View
    {
        return view('pages.register-management.diniyah');
    }
}
