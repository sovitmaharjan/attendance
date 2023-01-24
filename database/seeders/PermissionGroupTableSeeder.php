<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PermissionGroupTableSeeder extends Seeder
{
    public function run()
    {
        $arr = ['Dashboard', 'Permission Group', 'Permission', 'Company', 'Branch', 'Department', 'Designation', 'Employee', 'Shift', 'Shift Assignment', 'Holiday', 'Event', 'Event Assignment', 'Leave', 'Leave Assignment', 'Force Attendance', 'Leave List', 'Leave Application', 'Leave Cancellation', 'Dynamic Value', 'Quick Attendance', 'Datewise Attendance'];

        $permissionIds = [];

        // Dashboard
        $group = PermissionGroup::create([
            'name' => 'Dashboard'
        ]);
        $permission = Permission::create([
            'name' => 'VIEW_DASHBOARD',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;

        // Permission Group
        $group = PermissionGroup::create([
            'name' => 'Permission Group'
        ]);
        $permission = Permission::create([
            'name' => 'CREATE_PERMISSION_GROUP',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'EDIT_PERMISSION_GROUP',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'UPDATE_PERMISSION_GROUP',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'DELETE_PERMISSION_GROUP',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'VIEW_PERMISSION_GROUP',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;

        // Permission
        $group = PermissionGroup::create([
            'name' => 'Permission'
        ]);
        $permission = Permission::create([
            'name' => 'CREATE_PERMISSION',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'EDIT_PERMISSION',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'UPDATE_PERMISSION',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'DELETE_PERMISSION',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;
        $permission = Permission::create([
            'name' => 'VIEW_PERMISSION',
            'permission_group_id'=> $group->id
        ]);
        $permissionIds[] = $permission->id;








        $role = Role::create([
            'name' => 'Company Admin'
        ]);

        $role->permissions()->sync($permission->id);
    }
}
