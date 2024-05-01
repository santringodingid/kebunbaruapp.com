<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\SettingManagement\Institution;
use App\Models\SettingManagement\Period;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\False_;

class AuthController extends Controller
{
    public function index(): string
    {
        addJavascriptFile('assets/js/custom/authentication/sign-in/general.js');

        return view('pages/auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $period = Period::query()->orderBy('id', 'desc')->first();
        $institution = Institution::query()->find($request->user()?->institution_id);

        $request->session()->put([
            'institution_code' => $institution->code,
            'institution_name' => $institution->name,
            'status_access' => $institution->getRawOriginal('status_access'),
            'gender_access' => $institution->getRawOriginal('gender_access'),
            'masehi' => hijri()
        ]);

        $request->user()->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp(),
            'current_period' => $period?->id,
        ]);

//        return redirect()->intended('home');
        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
