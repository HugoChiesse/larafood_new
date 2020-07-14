<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    protected $service;

    public function __construct(OrderService $orderService)
    {
        $this->service = $orderService;
    }

    public function store(OrderRequest $request)
    {
        $order = $this->service->createNewOrder($request->all());

        return new OrderResource($order);
    }
}
