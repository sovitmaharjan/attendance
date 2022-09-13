<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = User::all();
    }

    public function create()
    {
        return view('dashboard');
    }

    public function store(EmployeeRequest $request) {
        $employee = User::create($request->validated())
    }
}
