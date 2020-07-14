<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientInterface;

class ClientRepository implements ClientInterface
{
    protected $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;
    }

    public function createNewClient(array $data)
    {
        return $this->entity->create($data);
    }

    public function getClient(int $id)
    {
        
    }
}