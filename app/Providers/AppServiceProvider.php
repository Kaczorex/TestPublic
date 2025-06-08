<?php

namespace App\Providers;

use App\Repositories\DogBreedApiRepository;
use App\Repositories\DogBreedIdentifierRepositoryInterface;
use App\Repositories\DogBreedRepositoryInterface;;

use App\Repositories\NyckelDogBreedIdentifierRepository;
use App\Services\NyckelAuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DogBreedRepositoryInterface::class, DogBreedApiRepository::class);
        $this->app->singleton(NyckelAuthService::class, function ($app) {
            return new NyckelAuthService();
        });
        
        $this->app->bind(DogBreedIdentifierRepositoryInterface::class, NyckelDogBreedIdentifierRepository::class);
        
    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
