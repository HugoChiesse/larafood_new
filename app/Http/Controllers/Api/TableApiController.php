<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    protected $service;

    public function __construct(TableService $tableService)
    {
        $this->service = $tableService;
    }

    public function getTablesByTenant(TenantFormRequest $request)
    {
        $tables = $this->service->getTablesByUuid($request->token_company);
        return TableResource::collection($tables);
    }

    public function show(TenantFormRequest $request, $identify)
    {
        // dd($identify);
        if (!$table = $this->service->getTableByIdentify($identify)) {
            return response()->json(['message' => 'Table not found'], 404);
        }
        return new TableResource($table);
    }
}
