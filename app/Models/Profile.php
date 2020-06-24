<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")->orWhere('description', 'like', "%{$filter}%")->orderBy('name')->paginate();
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionNotAttach($filter = '')
    {
        $permissions = Permission::whereNotIn('id', function ($query) {
            $query->select('permission_profile.permission_id')
                ->from('permission_profile')
                ->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter) {
                    $queryFilter->where('permissions.name', 'like', "%{$filter}%");
                }
            })
            ->orderBy('name')
            ->paginate();
        return $permissions;
    }
}
