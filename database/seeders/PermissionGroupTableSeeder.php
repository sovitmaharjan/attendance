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

        $permissionGroups = [
            [
                'name' => 'Dashboard',
                'permissions' => [
                    ['name' => 'VIEW_DASHBOARD'],
                ]
            ],
            [
                'name' => 'Permission Group',
                'permissions' => [
                    ['name' => 'VIEW_PERMISSION_GROUP'],
                    ['name' => 'ADD_PERMISSION_GROUP'],
                    ['name' => 'EDIT_PERMISSION_GROUP'],
                    ['name' => 'DELETE_PERMISSION_GROUP'],
                ]
            ],
            [
                'name' => 'Permission',
                'permissions' => [
                    ['name' => 'VIEW_PERMISSION'],
                    ['name' => 'ADD_PERMISSION'],
                    ['name' => 'EDIT_PERMISSION'],
                    ['name' => 'DELETE_PERMISSION'],
                ]
            ],
            [
                'name' => 'Company',
                'permissions' => [
                    ['name' => 'VIEW_COMPANY'],
                    ['name' => 'ADD_COMPANY'],
                    ['name' => 'EDIT_COMPANY'],
                    ['name' => 'DELETE_COMPANY'],
                ]
            ],
            [
                'name' => 'Branch',
                'permissions' => [
                    ['name' => 'VIEW_BRANCH'],
                    ['name' => 'ADD_BRANCH'],
                    ['name' => 'EDIT_BRANCH'],
                    ['name' => 'DELETE_BRANCH'],
                ]
            ],
            [
                'name' => 'Department',
                'permissions' => [
                    ['name' => 'VIEW_DEPARTMENT'],
                    ['name' => 'ADD_DEPARTMENT'],
                    ['name' => 'EDIT_DEPARTMENT'],
                    ['name' => 'DELETE_DEPARTMENT'],
                ]
            ],
            [
                'name' => 'Designation',
                'permissions' => [
                    ['name' => 'VIEW_DESIGNATION'],
                    ['name' => 'ADD_DESIGNATION'],
                    ['name' => 'EDIT_DESIGNATION'],
                    ['name' => 'DELETE_DESIGNATION'],
                ]
            ],
            [
                'name' => 'Employee',
                'permissions' => [
                    ['name' => 'VIEW_EMPLOYEE'],
                    ['name' => 'ADD_EMPLOYEE'],
                    ['name' => 'EDIT_EMPLOYEE'],
                    ['name' => 'DELETE_EMPLOYEE'],
                ]
            ],
            [
                'name' => 'Shift',
                'permissions' => [
                    ['name' => 'VIEW_SHIFT'],
                    ['name' => 'ADD_SHIFT'],
                    ['name' => 'EDIT_SHIFT'],
                    ['name' => 'DELETE_SHIFT'],
                ]
            ],
            [
                'name' => 'Shift Assignment',
                'permissions' => [
                    ['name' => 'VIEW_SHIFT_ASSIGNMENT'],
                    ['name' => 'ADD_SHIFT_ASSIGNMENT'],
                    ['name' => 'EDIT_SHIFT_ASSIGNMENT'],
                    ['name' => 'DELETE_SHIFT_ASSIGNMENT'],
                ]
            ],
            [
                'name' => 'Holiday',
                'permissions' => [
                    ['name' => 'VIEW_HOLIDAY'],
                    ['name' => 'ADD_HOLIDAY'],
                    ['name' => 'EDIT_HOLIDAY'],
                    ['name' => 'DELETE_HOLIDAY'],
                ]
            ],
            [
                'name' => 'Event',
                'permissions' => [
                    ['name' => 'VIEW_EVENT'],
                    ['name' => 'ADD_EVENT'],
                    ['name' => 'EDIT_EVENT'],
                    ['name' => 'DELETE_EVENT'],
                ]
            ],
            [
                'name' => 'Event Assignment',
                'permissions' => [
                    ['name' => 'VIEW_EVENT_ASSIGNMENT'],
                    ['name' => 'ADD_EVENT_ASSIGNMENT'],
                    ['name' => 'EDIT_EVENT_ASSIGNMENT'],
                    ['name' => 'DELETE_EVENT_ASSIGNMENT'],
                ]
            ],
            [
                'name' => 'Leave',
                'permissions' => [
                    ['name' => 'VIEW_LEAVE'],
                    ['name' => 'ADD_LEAVE'],
                    ['name' => 'EDIT_LEAVE'],
                    ['name' => 'DELETE_LEAVE'],
                ]
            ],
            [
                'name' => 'Leave Assignment',
                'permissions' => [
                    ['name' => 'VIEW_LEAVE_ASSIGNMENT'],
                    ['name' => 'ADD_LEAVE_ASSIGNMENT'],
                    ['name' => 'EDIT_LEAVE_ASSIGNMENT'],
                    ['name' => 'DELETE_LEAVE_ASSIGNMENT'],
                ]
            ],
            [
                'name' => 'Force Attendance',
                'permissions' => [
                    ['name' => 'VIEW_FORCE_ATTENDANCE'],
                    ['name' => 'ADD_FORCE_ATTENDANCE'],
                    ['name' => 'EDIT_FORCE_ATTENDANCE'],
                    ['name' => 'DELETE_FORCE_ATTENDANCE'],
                ]
            ],
            [
                'name' => 'Dynamic Value',
                'permissions' => [
                    ['name' => 'VIEW_DYNAMIC_VALUE'],
                    ['name' => 'ADD_DYNAMIC_VALUE'],
                    ['name' => 'EDIT_DYNAMIC_VALUE'],
                    ['name' => 'DELETE_DYNAMIC_VALUE'],
                ]
            ],
        ];

        foreach ($permissionGroups as $permissionGroup) {
            $createdPermissionGroup = PermissionGroup::create(['name' => $permissionGroup['name']]);
            foreach ($permissionGroup['permissions'] as $permission) {
                $createdPermissionGroup->permissions()->create(['name' => $permission['name']]);
            }
        }

//        $permissionIds = [];
//
//        // Dashboard
//        $group = PermissionGroup::create([
//            'name' => 'Dashboard'
//        ]);
//        $permission = Permission::create([
//            'name' => 'VIEW_DASHBOARD',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//
//        // Permission Group
//        $group = PermissionGroup::create([
//            'name' => 'Permission Group'
//        ]);
//        $permission = Permission::create([
//            'name' => 'CREATE_PERMISSION_GROUP',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'EDIT_PERMISSION_GROUP',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'UPDATE_PERMISSION_GROUP',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'DELETE_PERMISSION_GROUP',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'VIEW_PERMISSION_GROUP',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//
//        // Permission
//        $group = PermissionGroup::create([
//            'name' => 'Permission'
//        ]);
//        $permission = Permission::create([
//            'name' => 'CREATE_PERMISSION',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'EDIT_PERMISSION',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'UPDATE_PERMISSION',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'DELETE_PERMISSION',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;
//        $permission = Permission::create([
//            'name' => 'VIEW_PERMISSION',
//            'permission_group_id' => $group->id
//        ]);
//        $permissionIds[] = $permission->id;

        $permission_ids = Permission::pluck('id')->toArray();
        $role = Role::create([
            'name' => 'Superadmin'
        ]);

        $role->permissions()->sync($permission_ids);
//        $role->permissions()->sync($permission->id);
    }
}
