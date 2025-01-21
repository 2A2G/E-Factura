<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
class ApiController extends Controller
{
    protected $apiService;

    // Inyectamos el servicio en el constructor
    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService; // Guardamos la instancia en una propiedad
    }

    public function authenticate()
    {
        try {
            $data = $this->apiService->authenticate();

            return response()->json([
                'message' => 'Autenticación exitosa',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al autenticar',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
