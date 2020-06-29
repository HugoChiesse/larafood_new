<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = [
        'tenant_id', 'title', 'flag', 'image', 'price', 'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function search($filter)
    {
        return $this->where(function ($query) use ($filter) {
            $query->where('title', 'like', "%{$filter}%");
            $query->orWhere('flag', 'like', "%{$filter}%");
            $query->orWhere('price', $filter);
        })
            ->orderBy('title')
            ->paginate();
    }

    public function categoryNotAttach($filter = null)
    {
        $categories = Category::whereNotIn('categories.id', function ($query) {
            $query->select('category_product.category_id')
                ->from('category_product')
                ->whereRaw("category_product.product_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter) {
                    $queryFilter->where('categories.name', 'like', "%{$filter}%");
                }
            })
            ->orderBy('name')
            ->paginate();
        return $categories;
    }
}
