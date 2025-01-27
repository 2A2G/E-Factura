<?php

namespace App\Jobs;

use App\Services\ExternalApiService;
use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendFactureDian implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $apiService;

    public $tries = 3;
    public $backoff = 30;
    public $timeout = 180;
    // public $queue = 'default';

    /**
     * Inyectamos el servicio de API.
     *
     * @param ExternalApiService $apiService
     */
    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Indica hasta cuándo intentar reintentar el trabajo.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(10);
    }

    /**
     * Procesa el trabajo.
     */
    public function handle()
    {
        // Obtener todas las facturas pendientes de CUFE
        $billsWithoutCufe = Bill::whereNull('cufe')->get();

        Log::info("Iniciando el procesamiento de {$billsWithoutCufe->count()} facturas sin CUFE");

        foreach ($billsWithoutCufe as $bill) {
            try {
                Log::info("Procesando factura con ID: {$bill->id}");

                // Construcción y envío de datos
                $data = $this->apiService->constructFacture($bill->reference_code);
                return $data;
                $response = $this->apiService->sendFacture($data);

                // Validar la respuesta de la DIAN
                if (!$response || empty($response)) {
                    Log::warning("Respuesta inválida para factura ID: {$bill->id}");
                    continue;
                }

                // Actualizar el CUFE en la base de datos
                $bill->update(['cufe' => $response]);
                Log::info("CUFE actualizado correctamente para factura ID: {$bill->id}");

            } catch (\Exception $e) {
                Log::error("Error procesando factura ID: {$bill->id}: " . $e->getMessage());
            }
        }

        Log::info("Procesamiento completado");
    }
}
