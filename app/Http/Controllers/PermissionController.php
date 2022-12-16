<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Exception;

class PermissionController extends Controller
{

    public  function show()
    {
        //
    }

    public function index()
    {
        $data['permission'] = Permission::all();
        return view('permission.index', $data);
    }

    public function create()
    {
        $data['permission_group'] = PermissionGroup::all();
        return view('permission.create', $data);
    }

    public function store(PermissionRequest $request)
    {
        try {
            Permission::create($request->validated());
            return back()->with('success', 'Permission has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Permission $permission)
    {
        $data['permission'] = $permission;
        $data['permission_group'] = PermissionGroup::all();
        return view('permission.edit', $data);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $permission->update($request->validated());
            return redirect()->route('permission.index')->with('success', 'Permission has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('permission.index')->with('success', 'Permission has been deleted');
        } catch (Exception $e) {
            return redirect()->route('permission.index')->with('error', $e->getMessage());
        }
    }
}
