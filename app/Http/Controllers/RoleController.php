<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function index()
    {
        $data['role'] = Role::all();
        return view('role.index', $data);
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(RoleRequest $request)
    {
        try {
            Role::create($request->validated());
            return back()->with('success', 'Role has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Role $role)
    {
        return view('role.edit');
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role->update($request->validated());
            return redirect()->route('role.index')->with('success', 'Role has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('role.index')->with('success', 'Role has been deleted');
        } catch (Exception $e) {
            return redirect()->route('role.index')->with('error', $e->getMessage());
        }
    }
}
