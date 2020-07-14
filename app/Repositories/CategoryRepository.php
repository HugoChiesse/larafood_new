<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->select('categories.*')
            ->where('tenants.uuid', $uuid)
            ->paginate();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->paginate();
    }

    public function getCategoryByUuid(string $uuid)
    {
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();
    }
}
