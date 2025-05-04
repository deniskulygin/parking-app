<?php

declare(strict_types=1);

namespace App\Http\Response\Transformer;

use App\Models\ParkingLot;
use League\Fractal\TransformerAbstract;

class ParkingLotCollectionTransformer extends TransformerAbstract
{
    public function transform(ParkingLot $parkingLot): array
    {
        return [
            'id' => $parkingLot->getUniqueId(),
            'name' => $parkingLot->getName(),
            'spots_available' => $parkingLot->getAvailableSpotsCount(),
            'created_at' => $parkingLot->getCreatedAt(),
            'updated_at' => $parkingLot->getUpdatedAt(),
        ];
    }
}
