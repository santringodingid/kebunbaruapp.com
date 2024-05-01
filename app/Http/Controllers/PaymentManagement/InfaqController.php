<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfaqController extends Controller
{
    public function index()
    {
        return view('pages.payment-management.infaq');
    }
}
