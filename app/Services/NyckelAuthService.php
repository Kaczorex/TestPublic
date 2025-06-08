<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NyckelAuthService
{
    private string $clientId;
    private string $clientSecret;
    private string $tokenUrl;
    
    public function __construct()
    {
        $this->clientId = config('services.nyckel.client_id');
        $this->clientSecret = config('services.nyckel.client_token');
        $this->tokenUrl = config('services.nyckel.token_url');
    }
    
    /**
     * Pobiera access token, cache'uje do wygaśnięcia.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return Cache::remember('nyckel_access_token', 3500, function () {
            try {
                $response = Http::asForm()->post($this->tokenUrl, [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]);
                
                if ($response->failed()) {
                    Log::error(__('messages.nyckel_oauth_token_request_failed', ['status' => $response->status()]), [
                        'body' => $response->body(),
                    ]);
                    return null;
                }
                
                $json = $response->json();
                
                return $json['access_token'] ?? null;
                
            } catch (\Exception $e) {
                Log::error(__('messages.nyckel_oauth_token_exception', ['message' => $e->getMessage()]));
                return null;
            }
        });
    }
}
