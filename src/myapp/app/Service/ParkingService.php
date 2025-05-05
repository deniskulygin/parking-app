<?php

namespace App\Service;

use App\Dict\VehicleTypes;
use App\Exceptions\ApiException;
use App\Manager\ParkingManager;
use App\Manager\ParkingSpotManager;
use App\Manager\VehicleManager;
use App\Models\Parking;
use App\Models\ParkingSpot;
use App\Repository\ParkingRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

class ParkingService
{
    public function __construct(
        private readonly VehicleManager $vehicleManager,
        private readonly ParkingManager $parkingManager,
        private readonly ParkingRepository $parkingRepository,
        private readonly ParkingSpotManager $parkingSpotManager,
    ) {
    }

    /**
     * @throws ApiException
     * @throws BindingResolutionException|\Throwable
     */
    public function parkVehicle(ParkingSpot $spot, VehicleTypes $vehicleType): Parking
    {
        $vehicle = $this->vehicleManager->getOrCreate($vehicleType);

        $vehicle->getConnection()->beginTransaction();
        try {
            /** @var ParkingSpot $lockedSpot */
            $lockedSpot = ParkingSpot::query()
                ->where('id', $spot->getId())
                ->lockForUpdate()
                ->first();

            if ($lockedSpot->getIsOccupied()) {
                throw new ApiException("Parking spot already occupied");
            }

            $lockedSpot->setIsOccupied(true);
            $lockedSpot->save();

            $parking = $this->parkingManager->create(
                $vehicle->getId(),
                $lockedSpot->getId(),
            );

            $vehicle->getConnection()->commit();

            return $parking;
        } catch (ApiException $exception) {
            $vehicle->getConnection()->rollBack();

            throw $exception;
        } catch (\Throwable) {
            $vehicle->getConnection()->rollBack();

            throw new ApiException("Parking error");
        }
    }

    /**
     * @throws ApiException
     * @throws BindingResolutionException|\Throwable
     */
    public function unparkVehicle(ParkingSpot $spot): void
    {

        $spot->getConnection()->beginTransaction();
        try {
            /** @var ParkingSpot $lockedSpot */
            $lockedSpot = ParkingSpot::query()
                ->where('id', $spot->getId())
                ->lockForUpdate()
                ->first();

            if (false === $lockedSpot->getIsOccupied()) {
                return;
            }

            $parking = $this->parkingRepository->findByParkingSpotId($lockedSpot->getId());

            $this->parkingManager->unpark($parking);
            $this->parkingSpotManager->unoccupy($lockedSpot);

            $spot->getConnection()->commit();
        } catch (\Throwable) {
            $spot->getConnection()->rollBack();

            throw new ApiException("Unparking error");
        }
    }
}
