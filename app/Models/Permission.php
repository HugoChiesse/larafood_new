<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")->orWhere('description', 'like', "%{$filter}%")->orderBy('name')->paginate();
    }
}
