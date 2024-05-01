<?php

namespace App\Http\Controllers\SettingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index(): View
    {
        return view('pages.setting-management.period');
    }
}
