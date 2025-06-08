<?php

namespace App\Services;

use App\Repositories\DogBreedIdentifierRepositoryInterface;
use Illuminate\Http\UploadedFile;

class DogBreedIdentifierService
{
    private DogBreedIdentifierRepositoryInterface $repository;
    
    public function __construct(DogBreedIdentifierRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function identifyBreedFromFile(UploadedFile $file): ?string
    {
        return $this->repository->identifyByImageFile($file);
    }
}
