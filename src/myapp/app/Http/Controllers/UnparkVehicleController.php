<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Entity\ParkingSpotEntityResolver;
use App\Http\Request\UnparkVehicleRequest;
use App\Service\ParkingService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;

class UnparkVehicleController
{
    public function __construct(
        private readonly ParkingSpotEntityResolver $parkingSpotEntityResolver,
        private readonly ParkingService $parkingService,
    ) {
    }

    /**
     * @throws ApiException
     * @throws BindingResolutionException
     * @throws \Throwable
     */
    public function __invoke(UnparkVehicleRequest $request): Response
    {
        $parkingSpot = $this->parkingSpotEntityResolver->retrieveEntity($request->getParkingSpotId());

        $this->parkingService->unparkVehicle($parkingSpot);

        return new Response(status: 201);
    }
}
