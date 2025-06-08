<?php

namespace App\Repositories;

use App\Services\NyckelAuthService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NyckelDogBreedIdentifierRepository implements DogBreedIdentifierRepositoryInterface
{
    private string $apiUrl;
    private int $cacheTtl;
    private NyckelAuthService $authService;
    
    public function __construct(NyckelAuthService $authService)
    {
        $this->apiUrl = config('services.nyckel.base_url');
        $this->cacheTtl = (int) config('services.nyckel.cache_ttl', 3600);
        $this->authService = $authService;
    }
    
    public function identifyByImageFile(UploadedFile $file): ?string
    {
        $fileContent = file_get_contents($file->getRealPath());
        $mimeType = $file->getMimeType();
        
        $cacheKey = 'nyckel_dog_breed_' . md5($fileContent);
        
        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($fileContent, $mimeType) {
            $accessToken = $this->authService->getAccessToken();
            
            if ($accessToken === null) {
                Log::error(__('messages.nyckel_access_token_null'));
                return null;
            }
            
            $dataUri = 'data:' . $mimeType . ';base64,' . base64_encode($fileContent);
            
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ])->post($this->apiUrl, [
                    'data' => $dataUri,
                ]);
                
                if ($response->failed()) {
                    Log::error(__('messages.nyckel_api_request_failed', ['status' => $response->status()]), [
                        'body' => $response->body(),
                    ]);
                    return null;
                }
                
                $json = $response->json();
                
                return $json['labelName'] ?? null;
                
            } catch (\Exception $e) {
                Log::error(__('messages.nyckel_api_exception', ['message' => $e->getMessage()]));
                return null;
            }
        });
    }
}
