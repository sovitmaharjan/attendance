<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\PermissionGroup;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function index()
    {
        $data['roles'] = Role::all();
        return view('role.index', $data);
    }

    public function create()
    {
        $permission_groups = PermissionGroup::with('permissions')->get();
        return view('role.create', compact('permission_groups'));
    }

    public function store(RoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request->validated());
            $role->permissions()->sync($request->permissions);
            DB::commit();
            return back()->with('success', 'Role has been created');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Role $role)
    {
        $permission_groups = PermissionGroup::with('permissions')->get();
        return view('role.edit', compact('role', 'permission_groups'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();
            $role->update($request->validated());
            $role->permissions()->sync($request->permissions);
            DB::commit();
            return redirect()->route('role.index')->with('success', 'Role has been updated');
        } catch (Exception $e) {
            DB::rollBack();
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
