<?php

namespace App\Services;

use App\Repositories\DogBreedRepositoryInterface;

class DogBreedService
{
    protected DogBreedRepositoryInterface $repository;
    
    public function __construct(DogBreedRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function getBreeds(array $filters = []): array
    {
        $breeds = $this->repository->getAllBreeds();
        
        if (!empty($filters['name'])) {
            $breeds = array_filter($breeds, function ($breed) use ($filters) {
                return stripos($breed['name'], $filters['name']) !== false;
            });
        }
        
        
        return array_values($breeds);
    }
}
