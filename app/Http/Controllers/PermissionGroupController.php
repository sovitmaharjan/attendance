<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionGroupRequest;
use App\Models\PermissionGroup;
use Exception;

class PermissionGroupController extends Controller
{
    public function index()
    {
        $permission_group = PermissionGroup::all();
        return view("permission-group.index", compact("permission_group"));
    }

    public function create()
    {
        return view("permission-group.create");
    }

    public function store(PermissionGroupRequest $request)
    {
        try {
            PermissionGroup::create($request->validated());
            return back()->with("success", "Permission group has been created");
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    public function edit(PermissionGroup $permission_group)
    {
        return view("permission-group.edit", compact("permission_group"));
    }

    public function update(PermissionGroupRequest $request, PermissionGroup $permission_group)
    {
        try {
            $permission_group->update($request->validated());
            return redirect()->route("permission-group.index")->with("success", "Permission group has been updated");
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy(PermissionGroup $permission_group)
    {
        try {
            $permission_group->delete();
            return redirect()->route("permission-group.index")->with("success", "Permission group has been deleted");
        } catch (Exception $e) {
            return redirect()->route("permission-group.index")->with("error", $e->getMessage());
        }
    }
}
