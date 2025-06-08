<?php

use App\Http\Controllers\DogBreedController;
use App\Http\Controllers\DogBreedIdentifierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Endpoint do wylistowania wszystkich ras psów (jeśli masz implementację)
Route::get('/dog-breeds', [DogBreedController::class, 'index']);

// Endpoint do rozpoznawania rasy psa na podstawie przesłanego zdjęcia
Route::post('/dog-breed/identify', [DogBreedIdentifierController::class, 'identify']);
