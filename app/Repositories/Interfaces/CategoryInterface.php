<?php

namespace App\Repositories\Interfaces;

interface CategoryInterface
{
    public function getCategoriesByTenantUuid(string $uuid);
    public function getCategoriesByTenantId(int $idTenant);
    public function getCategoryByUrl(string $url);
}
