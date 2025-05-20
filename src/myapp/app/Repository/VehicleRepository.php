<?php

namespace App\Repository;

use App\Dict\VehicleTypes;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;

class VehicleRepository extends BaseRepository
{
    /**
     * @return Vehicle|Model|null
     */
    public function findByType(VehicleTypes $vehicleType): ?Vehicle
    {
        return $this->getModel()
            ->newQuery()
            ->where('type', '=', $vehicleType->value)
            ->first();
    }
}
