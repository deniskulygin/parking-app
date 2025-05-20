<?php

namespace App\Providers;

use App\Http\Controllers\GetParkingLotController;
use App\Http\Controllers\ParkVehicleController;
use App\Http\Controllers\UnparkVehicleController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    private const UNIQUE_ID_PATTERN = '[0-9a-fA-F\-]{36}';
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
        $router->post('/parking-spots/{parkingSpotUuid}/parkings', ParkVehicleController::class)
            ->where('parkingSpotUuid', self::UNIQUE_ID_PATTERN);

        $router->delete('/parking-spots/{parkingSpotUuid}/parkings', UnparkVehicleController::class)
            ->where('parkingSpotUuid', self::UNIQUE_ID_PATTERN);

        $router->get('/parking-lots', GetParkingLotController::class);
    }
}
