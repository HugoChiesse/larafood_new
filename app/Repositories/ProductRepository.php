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
            ->select('products.*')
            ->where('products.tenant_id', $idTenant)
            ->where(function ($query) use ($categories) {
                if ($categories != []) {
                    $query->whereIn('categories.uuid', $categories);
                }
            })
            ->get();
    }

    public function getProductByUuid(string $uuid)
    {
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();
    }
}
