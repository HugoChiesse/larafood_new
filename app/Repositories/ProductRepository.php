<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductsByTenantId(int $idTenant, array $categories = [])
    {
        return DB::table($this->table)
            ->join('category_product', 'category_product.product_id', 'products.id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->where('products.tenant_id', $idTenant)
            ->where(function ($query) use ($categories) {
                if ($categories != []) {
                    $query->whereIn('categories.url', $categories);
                }
            })
            ->get();
    }

    public function getProductByFlag(string $flag)
    {
        return DB::table($this->table)
            ->where('flag', $flag)
            ->first();
    }
}
