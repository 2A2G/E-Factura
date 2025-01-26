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

    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function handle()
    {
        Log::info('El job SendFactureDian se ha ejecutado.');

        $billsWithoutCufe = Bill::whereNull('cufe')->get();

        foreach ($billsWithoutCufe as $bill) {
            try {
                $response = $this->apiService->sendFacture($bill->reference_code);

                if ($response->successful()) {
                    $cufe = $response->json('cufe');

                    $bill->update(['cufe' => $cufe]);
                    Log::info('CUFE actualizado para Bill ID: ' . $bill->id);
                }
            } catch (\Exception $e) {
                Log::error('Excepción al procesar Bill ID: ' . $bill->id, [
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
