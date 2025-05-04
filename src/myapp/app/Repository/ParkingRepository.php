<?php

namespace App\Repository;

use App\Models\Parking;
use Illuminate\Database\Eloquent\Model;

class ParkingRepository extends BaseRepository
{
    /**
     * @return Parking|Model|null
     */
    public function findByParkingSpotId(int $parkingSpotId): ?Parking
    {
        return $this->getModel()
            ->newQuery()
            ->where('parking_spot_id', '=', $parkingSpotId)
            ->first();
    }
}
