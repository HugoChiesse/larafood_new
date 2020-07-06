<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\Interfaces\TenantInterface;

class ProductService
{
    protected $tenantInterface, $productInterface;

    public function __construct(TenantInterface $tenantInterface, ProductInterface $productInterface)
    {
        $this->tenantInterface = $tenantInterface;
        $this->productInterface = $productInterface;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantInterface->getTenantByUuid($uuid);
        return $this->productInterface->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductByFlag(string $flag)
    {
        return $this->productInterface->getProductByFlag($flag);
    }
}