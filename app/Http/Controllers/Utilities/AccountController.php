<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        $data = [
            'name' => Auth::user()->name,
            'institution' => Auth::user()->institution->name,
            'email' => Auth::user()->email,
            'username' => Auth::user()->username,
        ];
        return view('pages.utilities.account', compact('data'));
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'username' => 'required|string|alpha_num:ascii|max:25|unique:users,username,'.Auth::user()->id,
            'password_email' => 'required|current_password:web'
        ]);

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->username = $request->username;

        $user->save();

        Session::flash('success','Email dan username telah diganti');
        return redirect()->route('account');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'current_password' => 'required|current_password:web',
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('success-password','Password berhasil diganti');
        return redirect()->route('account');
    }
}
