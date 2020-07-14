<?php

namespace App\Services;

use App\Repositories\Interfaces\ClientInterface;

class ClientService
{
    protected $clientInterface;

    public function __construct(ClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    }

    public function createNewClient(array $data)
    {
        return $this->clientInterface->createNewClient($data);
    }
}