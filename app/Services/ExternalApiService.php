<?php

namespace App\Services;

use App\Models\Bill;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ExternalApiService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('services.external_api');
    }

    /**
     * Autenticar en la API para obtener el token.
     */
    public function authenticate()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])
            ->asForm()
            ->post(env('url_api') . '/oauth/token', [
                'grant_type' => env('grant_type'),
                'client_id' => env('client_id'),
                'client_secret' => env('client_secret'),
                'username' => env('usernameApi'),
                'password' => env('password'),
            ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->storeToken($data);
            return $data;
        }

        throw new \Exception('Error al autenticar en la API: ' . $response->body());
    }

    /**
     * Guardar el token en caché.
     */
    protected function storeToken(array $data)
    {
        $token = $data['access_token'];
        $expiresIn = $data['expires_in'];

        Cache::put('external_api_token', $token, $expiresIn - 60); // Margen de 60 segundos
        Cache::put('external_api_token_expires_at', now()->addSeconds($expiresIn - 60));
    }

    /**
     * Obtener el token desde el caché.
     */
    public function getToken()
    {
        return Cache::get('external_api_token');
    }

    public function isAutenticate()
    {
        if (!Cache::get('external_api_token')) {
            $this->authenticate();
        }

    }

    public function constructFacture($reference_code)
    {
        $bill = Bill::where('reference_code', $reference_code)->first();
        if (!$bill) {
            throw new \Exception('Factura no encontrada');
        }

        return [
            "numbering_range_id" => "",
            "reference_code" => $bill->reference_code ?? "",
            "observation" => $bill->observation ?? "",
            "payment_form" => $bill->payment_form ?? "1",
            "payment_due_date" => $bill->payment_due_date ?? now()->addDays(30)->toDateString(),
            "payment_method_code" => $bill->payment_method_code ?? "10",
            "billing_period" => [
                "start_date" => $bill->billing_period_start_date ?? now()->startOfMonth()->toDateString(),
                "start_time" => "00:00:00",
                "end_date" => $bill->billing_period_end_date ?? now()->endOfMonth()->toDateString(),
                "end_time" => "23:59:59",
            ],
            "customer" => [
                "identification" => $bill->client->number_identity ?? "",
                "dv" => "3",
                "company" => $bill->customer_company ?? "",
                "trade_name" => $bill->customer_trade_name ?? "",
                "names" => $bill->client->name_client ?? "",
                "address" => $bill->client->address_client ?? "",
                "email" => $bill->client->email_client ?? "",
                "phone" => $bill->client->phone_client ?? "",
                "legal_organization_id" => "2",
                "tribute_id" => "21",
                "identification_document_id" => $bill->client->type_identity ?? "",
                "municipality_id" => env('municipality_id') ?? "",
            ],
            "items" => $bill->orders->map(function ($item) {
                return [
                    "code_reference" => $item->product->code_product,
                    "name" => $item->product->name_product,
                    "quantity" => $item->amount,
                    "discount_rate" => $item->discount_rate ?? 0,
                    "price" => $item->total_price,
                    "tax_rate" => $item->tax_rate,
                    "unit_measure_id" => "70",
                    "standard_code_id" => "1",
                    "is_excluded" => "0",
                    "tribute_id" => "1",
                    "withholding_taxes" => [],
                ];
            })->toArray(),
        ];
    }

    public function sendFacture(array $data)
    {
        $token = $this->getToken();

        if (!$token) {
            throw new \Exception('No se encontró el token. Asegúrate de autenticarte primero.');
        }

        $response = Http::withOptions(['verify' => false])
            ->withToken($token)
            ->post(env('url_api') . '/v1/bills/validate', $data);

        if ($response->successful()) {
            dd($response->json());
            return $response->json();
        }

        throw new \Exception('Error al enviar la factura: ' . $response->body());
    }

    public function getFacture()
    {
        $token = $this->getToken();

        if (!$token) {
            throw new \Exception('No se encontró el token. Asegúrate de autenticarte primero.');
        }

        $response = Http::withOptions(['verify' => false])
            ->withToken($token)
            ->get(env('url_api') . '/v1/bills/');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Error al enviar la factura: ' . $response->body());
    }
    public function searchFacture($number): mixed
    {
        try {
            $token = $this->getToken();

            if (!$token) {
                throw new \Exception('No se encontró el token. Asegúrate de autenticarte primero.');
            }

            $response = Http::withOptions(['verify' => false])
                ->withToken($token)
                ->get(env('url_api') . "/v1/bills/show/{$number}");

            if ($response->successful()) {
                return $response->json();
            }

            throw new \Exception('Error al buscar la factura: ' . $response->body());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al buscar la factura',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
