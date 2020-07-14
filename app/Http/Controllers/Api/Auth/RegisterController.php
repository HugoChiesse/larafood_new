<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $service;

    public function __construct(ClientService $clientService)
    {
        $this->service = $clientService;
    }

    public function store(ClientRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $client = $this->service->createNewClient($data);
        return new ClientResource($client);
    }
}
