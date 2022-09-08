<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\PermissionRequest;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::all();
        return view('permission.index', compact('permission'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->name);
        return back()->with('success', 'Permission created successfully');
    }
}