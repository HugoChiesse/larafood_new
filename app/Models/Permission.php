<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
    
    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")->orWhere('description', 'like', "%{$filter}%")->orderBy('name')->paginate();
    }
}
