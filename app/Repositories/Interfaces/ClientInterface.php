<?php

namespace App\Repositories\Interfaces;

interface ClientInterface
{
    public function createNewClient(array $data);
    public function getClient(int $id);
}