<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $service;

    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function getCategoriesByTenant(TenantFormRequest $request)
    {
        // if ($request->token_company) {
        //     return response()->json(["message" => "Token not found"], 404);
        // }
        $categories = $this->service->getCategoriesByUuid($request->token_company);
        return CategoryResource::collection($categories);
    }

    public function show(TenantFormRequest $request, $identify)
    {
        if (!$category = $this->service->getCategoryByIdentify($identify)) {
            return response()->json(['message' => 'Ctegory not found'], 404);
        }
        return new CategoryResource($category);
    }
}
