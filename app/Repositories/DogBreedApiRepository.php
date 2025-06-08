<?php

namespace App\Repositories;

use App\Exceptions\DogBreedApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DogBreedApiRepository implements DogBreedRepositoryInterface
{
    protected string $baseUrl;
    protected string $apiKey;
    
    public function __construct()
    {
        $this->baseUrl = config('services.thedogapi.base_url');
        $this->apiKey = config('services.thedogapi.key');
    }
    
    public function getAllBreeds(): array
    {
        return Cache::remember('dog_breeds', config('services.thedogapi.cache_ttl', 86400), function () {
            try {
                $response = Http::withHeaders([
                    'x-api-key' => $this->apiKey,
                ])->get($this->baseUrl . 'breeds');
                
                Log::info(__('messages.external_api_request'), [
                    'endpoint' => $this->baseUrl,
                    'status' => $response->status(),
                ]);
                
                if ($response->successful()) {
                    return $response->json();
                }
                
                Log::error('DogAPI error: ' . $response->status());
                throw new DogBreedApiException(__('messages.dogapi_error_status', ['status' => $response->status()]));
            } catch (\Exception $e) {
                Log::error('DogAPI request failed: ' . $e->getMessage());
                throw new DogBreedApiException(__('messages.dogapi_connection_error'));
            }
        });
    }
}
