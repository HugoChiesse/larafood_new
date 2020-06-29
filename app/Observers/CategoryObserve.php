<?php

namespace App\Observers;

use App\Models\Category;
use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryObserve
{
    /**
     * Handle the category "creating" event.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Category $category)
    {
        $category->url = Str::kebab($category->name);
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updating(Category $category)
    {
        $category->url = Str::kebab($category->name);
    }
}
