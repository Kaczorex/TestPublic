<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdentifyDogBreedRequest;
use App\Services\DogBreedIdentifierService;
use Illuminate\Http\JsonResponse;

class DogBreedIdentifierController extends Controller
{
    private DogBreedIdentifierService $service;
    
    public function __construct(DogBreedIdentifierService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle POST request with image upload and return identified breed.
     *
     * @param IdentifyDogBreedRequest $request
     * @return JsonResponse
     */
    public function identify(IdentifyDogBreedRequest $request): JsonResponse
    {
        $file = $request->file('image');
        
        $breed = $this->service->identifyBreedFromFile($file);
        
        if ($breed === null) {
            return response()->json([
                'error' => __('messages.breed_not_recognized'),
            ], 422);
        }
        
        return response()->json(['breed' => $breed]);
    }
}
