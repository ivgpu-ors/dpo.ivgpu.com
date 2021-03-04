<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    /**
     * @var ClientService
     */
    private ClientService $srv;

    /**
     * UserController constructor.
     * @param ClientService $srv
     */
    public function __construct(ClientService $srv)
    {
        $this->srv = $srv;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->srv->all());
    }
}
