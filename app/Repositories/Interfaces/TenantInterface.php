<?php

namespace App\Repositories\Interfaces;

interface TenantInterface
{
    public function getAllTenants(int $per_page);
    public function getTenantByUuid(string $uuid);
}
