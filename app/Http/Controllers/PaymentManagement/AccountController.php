<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(): View
    {
        return view('pages.payment-management.account');
    }
}
