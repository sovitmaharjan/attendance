<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        try{
            User::create($request->validated());
            return back()->with('success', 'User created successfully');
        }catch (Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
