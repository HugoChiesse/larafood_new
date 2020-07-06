<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Interfaces\TenantInterface;
use Illuminate\Support\Str;

class TenantService
{

    private $plan, $data = [];
    protected $interface;

    public function __construct(TenantInterface $interface)
    {
        $this->interface = $interface;
    }

    public function getAllTenants(int $per_page)
    {
        return $this->interface->getAllTenants($per_page);
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->interface->getTenantByUuid($uuid);
    }

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);
        return $user;
    }

    public function storeTenant()
    {
        return $this->plan->tenants()->create([
            'cnpj'          => $this->data['cnpj'],
            'name'          => $this->data['empresa'],
            'email'         => $this->data['email'],

            'subscription'  => now(),
            'expires_at'    => now()->addDays(7),
        ]);
    }

    public function storeUser($tenant)
    {
        return $tenant->users()->create([
            'name'          => $this->data['name'],
            'email'         => $this->data['email'],
            'password'      => bcrypt($this->data['password']),
        ]);
    }
}
