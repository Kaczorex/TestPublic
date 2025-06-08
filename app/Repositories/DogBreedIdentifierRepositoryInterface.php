<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;

interface DogBreedIdentifierRepositoryInterface
{
    public function identifyByImageFile(UploadedFile $file): ?string;
}