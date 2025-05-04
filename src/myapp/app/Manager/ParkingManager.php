<?php

namespace App\Manager;

use App\Models\Parking;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

class ParkingManager
{
    public function __construct(private readonly Container $container)
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function create(int $vehicleId, int $parkingSpotId): Parking
    {
        $submission = $this->getModel();

        $submission
            ->setVehicleId($vehicleId)
            ->setParkingSpotId($parkingSpotId)
            ->save();

        return $submission;
    }

    /**
     * @throws BindingResolutionException
     */
    public function unpark(Parking $parking): void
    {
        $parking->setUnparked(true)->save();
    }

    /**
     * @throws BindingResolutionException
     */
    private function getModel(): Parking
    {
        return $this->container->make(Parking::class);
    }
}
