<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    protected $service;

    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {
        $products = $this->service->getProductsByTenantUuid($request->token_company, $request->get('categories', []));
        return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $flag)
    {
        if (!$product = $this->service->getProductByFlag($flag)) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }
        return new ProductResource($product);
    }
}
