<?php

namespace App\Http\Controllers;

use App\Services\DogBreedService;
use Illuminate\Http\Request;

class DogBreedController extends Controller
{
    protected DogBreedService $dogBreedService;
    
    public function __construct(DogBreedService $dogBreedService)
    {
        $this->dogBreedService = $dogBreedService;
    }
    
    public function index(Request $request)
    {
        $filters = $request->only(['name', 'sortKey', 'sortAsc']);
        
        $breeds = $this->dogBreedService->getBreeds($filters);
        
        return inertia('DogBreeds/Index', [
            'breeds' => $breeds,
            'filters' => $filters,
        ]);
    }

}
