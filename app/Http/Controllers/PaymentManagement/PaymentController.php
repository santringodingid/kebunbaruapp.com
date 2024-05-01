<?php

namespace App\Http\Controllers\PaymentManagement;

use App\Http\Controllers\Controller;
use App\Models\PaymentManagement\Payment;
use App\Models\RegisterManagement\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('pages.payment-management.payment');
    }

    public function print($id)
    {
        return view('prints.payment', [
            'payment' => Payment::with('registrationHasOne')->find($id)
        ]);
    }
}
