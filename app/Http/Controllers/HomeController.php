<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $students =
        $data = [
            'name' => Auth::user()->name
        ];

        return view('pages.home', compact('data'));
    }
}
