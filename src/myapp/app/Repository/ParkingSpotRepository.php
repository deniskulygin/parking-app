<?php

namespace App\Repository;

use App\Models\ParkingSpot;
use Illuminate\Database\Eloquent\Model;

class ParkingSpotRepository extends BaseRepository
{
    /**
     * @return ParkingSpot|Model|null
     */
    public function findByUniqueId(string $teamUid): ?ParkingSpot
    {
        return $this->getModel()
            ->newQuery()
            ->where('unique_id', '=', $teamUid)
            ->first();
    }
}
