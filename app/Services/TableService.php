<?php

namespace App\Services;

use App\Repositories\Interfaces\TableInterface;
use App\Repositories\Interfaces\TenantInterface;

class TableService
{
    protected $tenantInterface, $tableInterface;
 
    public function __construct(TenantInterface $tenantInterface, TableInterface $tableInterface)
    {
        $this->tenantInterface = $tenantInterface;
        $this->tableInterface = $tableInterface;
    }

    public function getTablesByUuid(string $uuid)
    {
        $tenant = $this->tenantInterface->getTenantByUuid($uuid);
        return $this->tableInterface->getTablesByTenantId($tenant->id);
    }

    public function getTableByIdentify(string $identify)
    {
        return $this->tableInterface->getTableByIdentify($identify);
    }
}