<?php

declare(strict_types=1);

namespace App\Data;

final class VehicleTypes
{
    public const CAR = 'car';
    public const MOTORCYCLE = 'motorcycle';
    public const VAN = 'van';

    public static function getVehicleTypesAsString(): string
    {
        return implode(',', [
            self::CAR,
            self::MOTORCYCLE,
            self::VAN
        ]);
    }
}
