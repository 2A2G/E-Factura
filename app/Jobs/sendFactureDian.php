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
        Bill::whereNull('cufe')
            ->chunk(100, function ($bills) {
                Log::info("Iniciando el procesamiento de " . count($bills) . " facturas sin CUFE");

                // Usamos un array para almacenar los CUFE actualizados
                $updatedBills = [];

                foreach ($bills as $bill) {
                    try {
                        Log::info("Procesando factura con ID: {$bill->id}");

                        $data = $this->apiService->constructFacture($bill->reference_code);
                        // Log::info("Datos a enviar: " . json_encode($data));

                        $cufe = $this->apiService->sendFacture($data);
                        if (!$cufe || empty($data)) {
                            Log::warning("Respuesta inválida para factura ID: {$bill->id}. Respuesta de la API: " . $data);
                            continue;

                        }

                        $updatedBills[] = [
                            'id' => $bill->id,
                            'cufe' => $cufe,
                        ];

                        Log::info("CUFE actualizado correctamente para factura ID: {$bill->id}");

                    } catch (\Exception $e) {
                        Log::error("Error procesando factura ID: {$bill->id}: " . $e->getMessage());
                    }
                }

                foreach ($updatedBills as $updatedBill) {
                    Bill::where('id', $updatedBill['id'])
                        ->update(['cufe' => $updatedBill['cufe']]);
                }

                Log::info("Procesamiento completado para este lote");
            });
    }

}
