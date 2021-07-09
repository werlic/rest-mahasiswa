<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (!auth('mahasiswa')->attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth('mahasiswa')->user()->createToken('authToken')->accessToken;

        return response(['message' => 'Login success!!','access_token' => $accessToken]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user('mahasiswa')->token();
        $user->revoke();

        return response(['message' => 'Your logout!!']);
    }
}
