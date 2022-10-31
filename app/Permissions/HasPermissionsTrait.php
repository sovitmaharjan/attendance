<?php

namespace App\Permissions;

trait HasPermissionsTrait
{
    public function role()
    {
        return $this->belongsTo("App\Models\User", 'role_id', 'id');
    }

    public function permissions()
    {
        $permissions = [];
        foreach ($this->role->permissions as $permission){
            $permissions[] = $permission;
        }
        return $permissions;
    }

    public function hasPermission($permission)
    {
        foreach ($this->permissions() as $p){
            if ($p->slug == $permission){
                return true;
            }
        }
        return false;
    }
}
