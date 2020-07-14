<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderInterface;
use App\Repositories\Interfaces\TableInterface;
use App\Repositories\Interfaces\TenantInterface;

class OrderService
{
    protected $tenantInterface, $orderInterface, $tableInterface;

    public function __construct(
        TenantInterface $tenantInterface,
        OrderInterface $orderInterface,
        TableInterface $tableInterface
    ) {
        $this->tenantInterface = $tenantInterface;
        $this->orderInterface = $orderInterface;
        $this->tableInterface = $tableInterface;
    }

    public function createNewOrder(array $order)
    {

        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder([]);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');

        $order = $this->orderInterface->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        return $order;
    }

    private function getIdentifyOrder(int $qtyCharacters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuwvxyz');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $characters = $smallLetters . $numbers;
        $identify = substr(str_shuffle($characters), 0, $qtyCharacters);

        return $identify;
    }

    private function getTotalOrder(array $products): float
    {
        return (float) 90;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantInterface->getTenantByUuid($uuid);
        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableInterface->getTableByIdentify($uuid);
            return $table->id;
        }
        return $uuid;
    }

    private function getClientIdByOrder()
    {
        return auth()->check() ? auth()->user()->id : '';
    }
}
