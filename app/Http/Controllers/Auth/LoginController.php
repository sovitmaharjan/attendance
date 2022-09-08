<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('id', 'password'))) {
            return back();
        }
        return redirect('dashboard')->with('success', 'Login successful');
    }

    public function logout() {
        auth()->logout();
        return redirect('login')->with('success', 'Logout successful');
    }
}
