<?php

declare(strict_types=1);

namespace App\Http\Entity;

use App\Exceptions\ApiErrorCode;
use App\Exceptions\ApiErrorMessage;
use App\Exceptions\ApiException;
use App\Models\ParkingSpot;
use App\Repository\ParkingSpotRepository;

class ParkingSpotEntityResolver
{
    private ?ParkingSpot $parkingSpot = null;

    public function __construct(private readonly ParkingSpotRepository $parkingSpotRepository)
    {
    }

    /**
     * @throws ApiException
     */
    public function retrieveEntity(string $uniqueId): ParkingSpot
    {
        if ($this->parkingSpot !== null) {
            return $this->parkingSpot;
        }

        $this->parkingSpot = $this->parkingSpotRepository->findByUniqueId($uniqueId);

        if ($this->parkingSpot === null) {
            throw new ApiException(
                ApiErrorMessage::PARKING_SPOT_NOT_FOUND,
                ApiErrorCode::PARKING_SPOT_NOT_FOUND
            );
        }

        return $this->parkingSpot;
    }
}
