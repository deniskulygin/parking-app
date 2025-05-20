<?php

namespace App\Manager;

use App\Models\ParkingSpot;

class ParkingSpotManager
{
    public function unoccupy(ParkingSpot $parkingSpot): void
    {
        $parkingSpot->setIsOccupied(false)->save();
    }
}
