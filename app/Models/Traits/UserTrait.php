<?php

namespace App\Models\Traits;

trait UserTrait
{
    public function permissions()
    {
        $plan = $this->tenant->plan;
        $permissions = [];
        foreach ($plan->profiles as $key => $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }

    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin()
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
