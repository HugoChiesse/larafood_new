<?php

namespace App\Repositories\Interfaces;

interface OrderInterface
{
    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $tableId = ''
    );
    public function getOrderByIdentify(string $identify);
}
