<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $map = [
        \App\Repository\ParkingSpotRepository::class => \App\Models\ParkingSpot::class,
        \App\Repository\VehicleRepository::class => \App\Models\Vehicle::class,
        \App\Repository\ParkingRepository::class => \App\Models\Parking::class,
    ];

    public function register(): void
    {
        foreach ($this->map as $repositoryClass => $modelClass) {
            $this->app->singleton($repositoryClass, function () use ($repositoryClass, $modelClass) {
                return new $repositoryClass($this->app->make($modelClass));
            });
        }
    }
}
