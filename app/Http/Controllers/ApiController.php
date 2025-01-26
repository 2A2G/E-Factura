<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
class ApiController extends Controller
{
    protected $apiService;

    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService;
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

    public function sendFacture($facture_id)
    {
        try {
            $data = $this->apiService->constructFacture($facture_id);

            $response = $this->apiService->sendFacture($data);

            return response()->json([
                'message' => 'Factura enviada con éxito',
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al enviar la factura',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function getFacture()
    {
        try {
            $response = $this->apiService->getFacture();

            return response()->json([
                'message' => 'Facturas obtenidas con éxito',
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las facturas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function searchFacture($numerReference)
    {
        try {
            $response = $this->apiService->searchFacture($numerReference);

            return response()->json([
                'message' => 'Factura enviada con éxito',
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al enviar la factura',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function viewFacture($numerReference)
    {
        try {
            $response = $this->apiService->searchFacture($numerReference);
            $qrUrl = $response['data']['bill']['qr'];
            return redirect($qrUrl);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al enviar la factura',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
