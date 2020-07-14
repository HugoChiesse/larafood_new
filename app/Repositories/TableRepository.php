<?php

namespace App\Repositories;

use App\Repositories\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->select('tables.*')
            ->where('tenants.uuid', $uuid)
            ->paginate();
    }

    public function getTablesByTenantId(int $id)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->select('tables.*')
            ->where('tenants.id', $id)
            ->orderBy('identify')
            ->paginate();
    }

    public function getTableByIdentify(string $uuid)
    {
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();
    }
}
