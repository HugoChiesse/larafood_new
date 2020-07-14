<?php

namespace App\Repositories\Interfaces;

interface ProductInterface
{
    public function getProductsByTenantId(int $idTenant, array $categories = []);
    public function getProductByUuid(string $uuid);
}