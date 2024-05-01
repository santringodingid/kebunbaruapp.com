<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages/dashboards.index');
    }

    public function about()
    {
        return view('pages/abouts.index');
    }
}
