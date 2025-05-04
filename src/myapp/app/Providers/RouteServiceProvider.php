<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    private const UNIQUE_ID_PATTERN = '[a-z0-9]{40}';
    public const HOME = '/home';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        /** @var Router $router */
        $router = $this->app->make('router');

        $this->routes(function () use ($router) {
            $router->middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            $router->middleware('web')
                ->group(base_path('routes/web.php'));

            $router->namespace('App\Http\Controllers')
                ->prefix('api/v1')
                ->group(fn() => $this->mapRoutes($router));
        });
    }

    private function mapRoutes(Router $router): void
    {
        /** @uses  \App\Http\Controllers\ParkVehicleController::__invoke */
        $router->post('/parking-spots/{parkingSpotUuid}/parkings', 'ParkVehicleController')
            ->where('parkingSpotUuid', self::UNIQUE_ID_PATTERN);

        /** @uses  \App\Http\Controllers\UnparkVehicleController::__invoke */
        $router->delete('/parking-spots/{parkingSpotUuid}/parkings', 'UnparkVehicleController')
            ->where('parkingSpotUuid', self::UNIQUE_ID_PATTERN);

        /** @uses  \App\Http\Controllers\GetParkingLotController::__invoke */
        $router->get('/parking-lots', 'GetParkingLotController');
    }
}
