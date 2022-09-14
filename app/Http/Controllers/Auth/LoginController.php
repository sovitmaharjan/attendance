<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return auth()->user() ? redirect("dashboard") : view("auth.login");
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back()->with("error", "Invalid credentials");
        }
        return redirect("dashboard")->with("success", "Login successful");
    }

    public function logout()
    {
        auth()->logout();
        return redirect("login")->with("success", "Logout successful");
    }
}
