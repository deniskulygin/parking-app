<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Entity\ParkingSpotEntityResolver;
use App\Http\Request\ParkVehicleRequest;
use App\Mapper\VehicleTypeMapper;
use App\Service\ParkingService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;

class ParkVehicleController
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
    public function __invoke(ParkVehicleRequest $request): Response
    {
        $parkingSpot = $this->parkingSpotEntityResolver->retrieveEntity($request->getParkingSpotId());

        $parking = $this->parkingService->parkVehicle($parkingSpot, VehicleTypeMapper::fromRequestType($request->getType()));

        return new Response(['id' => $parking->getUniqueId()], 201);
    }
}
