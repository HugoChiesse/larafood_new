<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'url', 'price', 'description'
    ];

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function search($filter = null)
    {
        return $this->where('name', 'like', "%{$filter}%")->orWhere('description', 'like', "%{$filter}%")->orderBy('name')->paginate();
    }

    public function profilesNotAttach($filter = '')
    {
        $profiles = Profile::whereNotIn('id', function ($query) {
            $query->select('plan_profile.profile_id')
                ->from('plan_profile')
                ->whereRaw("plan_profile.plan_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter) {
                    $queryFilter->where('profiles.name', 'like', "%{$filter}%");
                }
            })
            ->orderBy('name')
            ->paginate();
        return $profiles;
    }
}
