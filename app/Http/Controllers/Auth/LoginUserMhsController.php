<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginUserMhsController extends Controller
{
    // use AuthenticatesUsers;
    // //

    // public function username()
    // {
    //     return 'nim';
    // }
    public function login()
    {
        if (Auth::guard('mahasiswa')->check()) {
            return redirect()->route('home');
        }
        return view('auth.login-mahasiswa');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('mahasiswa')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'nim' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.mahasiswa');
    }
}
