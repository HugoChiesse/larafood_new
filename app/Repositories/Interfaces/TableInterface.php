<?php

namespace App\Repositories\Interfaces;

interface TableInterface
{
    public function getTablesByTenantUuid(string $uuid);
    public function getTablesByTenantId(int $id);
    public function getTableByIdentify(string $uuid);
}