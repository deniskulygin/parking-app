<?php

namespace App\Manager;

use App\Dict\VehicleTypes;
use App\Models\Vehicle;
use App\Repository\VehicleRepository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

class VehicleManager
{
    public function __construct(
        private readonly Container $container,
        private readonly VehicleRepository $vehicleRepository,
    ) {
    }

    /**
     * @throws BindingResolutionException
     */
    public function getOrCreate(VehicleTypes $type): Vehicle
    {
        $vehicle = $this->vehicleRepository->findByType($type);
        if (null !== $vehicle) {
            return $vehicle;
        }

        $vehicle = $this->getModel();

        $vehicle->setType($type->value)->save();

        return $vehicle;
    }

    /**
     * @throws BindingResolutionException
     */
    private function getModel(): Vehicle
    {
        return $this->container->make(Vehicle::class);
    }
}
