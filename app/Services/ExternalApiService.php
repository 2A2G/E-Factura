<?php

namespace App\Services;

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
}
