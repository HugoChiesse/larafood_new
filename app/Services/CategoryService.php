<?php 

namespace App\Services;

use App\Repositories\Interfaces\CategoryInterface;
use App\Repositories\Interfaces\TenantInterface;

class CategoryService
{
    protected $tenantInterface, $categoryInterface;

    public function __construct(TenantInterface $tenantInterface, CategoryInterface $categoryInterface)
    {
        $this->tenantInterface = $tenantInterface;
        $this->categoryInterface = $categoryInterface;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantInterface->getTenantByUuid($uuid);
        return $this->categoryInterface->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByUrl(string $url)
    {
        return $this->categoryInterface->getCategoryByUrl($url);
    }
}