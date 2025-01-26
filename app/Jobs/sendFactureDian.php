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

    public $tries = 5;

    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function handle()
    {
        // Log::info('Iniciando trabajo SendFactureDian');

        $billsWithoutCufe = Bill::whereNull('cufe')->get();
        // Log::info('Facturas sin CUFE encontradas: ' . $billsWithoutCufe->count());

        foreach ($billsWithoutCufe as $bill) {
            Log::info('Procesando Bill ID: ' . $bill->id);
            try {
                // Log::info('Construyendo Factura');

                $data = $this->apiService->constructFacture($bill->reference_code);
                // Log::info('Enviando factura');

                $response = $this->apiService->sendFacture($data);
                // Log::info('Respuesta de la DIAN', ['response' => $response]);

                if (!$response) {
                    Log::error('Error al recibir la respuesta de la DIAN', ['response' => $response]);
                    continue;
                }

                $cufe = $response;
                if (!$cufe) {
                    Log::error('CUFE no encontrado en la respuesta de la DIAN para Bill ID: ' . $bill->id);
                    continue;
                }

                $bill->update(['cufe' => $cufe]);
                Log::info('CUFE actualizado para Bill ID: ' . $bill->id);

            } catch (\Exception $e) {
                Log::error('Excepción al procesar Bill ID: ' . $bill->id, [
                    'error' => $e->getMessage(),
                    'stack' => $e->getTraceAsString(),
                ]);
            }
        }
    }

}
