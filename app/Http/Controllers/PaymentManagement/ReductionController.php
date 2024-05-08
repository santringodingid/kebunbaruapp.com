<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReductionController extends Controller
{
    public function index()
    {
        return view('pages.payment-management.reduction');
    }
}
