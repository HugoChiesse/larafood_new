<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $fillable = ['plan_id', 'name'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
