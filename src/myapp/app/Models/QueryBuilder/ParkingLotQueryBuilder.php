<?php

namespace App\Models\QueryBuilder;

use App\Models\ParkingLot;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class ParkingLotQueryBuilder extends EloquentBuilder
{
    public function getAllAvailable(): EloquentBuilder
    {
        return $this->where(ParkingLot::TABLE_NAME . '.is_available', '=', true);
    }
}
