<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupTableSeeder extends Seeder
{
    public function run()
    {
        $group = PermissionGroup::create([
            'name' => 'Dashboard',
        ]);

        $permission = Permission::create([
           'name' => 'VIEW_DASHBOARD',
           'permission_group_id'=> $group->id
        ]);

        $role = Role::create([
            'name' => 'Company Admin'
        ]);

        $role->permissions()->sync($permission->id);
    }
}
