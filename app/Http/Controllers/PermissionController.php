<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Exception;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::all();
        return view("permission.index", compact("permission"));
    }

    public function create()
    {
        $permission_group = PermissionGroup::all();
        return view("permission.create", compact("permission_group"));
    }

    public function store(PermissionRequest $request)
    {
        try {
            Permission::create($request->validated());
            return back()->with("success", "Permission has been created");
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    public function edit(Permission $permission)
    {
        $permission_group = PermissionGroup::all();
        return view("permission.edit", compact("permission_group"));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $permission->update($request->validated());
            return redirect()->route("permission.index")->with("success", "Permission has been updated");
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route("permission.index")->with("success", "Permission has been deleted");
        } catch (Exception $e) {
            return redirect()->route("permission.index")->with("error", $e->getMessage());
        }
    }
}
