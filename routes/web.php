<?php

use App\Http\Controllers\DogBreedController;
use App\Http\Controllers\DogBreedIdentifierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DogBreedController::class, 'index'])->name('dog-breeds.index');

Route::post('/dog-breed/identify', [DogBreedIdentifierController::class, 'identify']);