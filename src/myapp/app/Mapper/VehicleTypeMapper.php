<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dict\VehicleTypes;
use App\Data\VehicleTypes as VehicleTypesData;
use InvalidArgumentException;

final class VehicleTypeMapper
{
    private const MAP = [
        VehicleTypesData::CAR => VehicleTypes::CAR,
        VehicleTypesData::MOTORCYCLE => VehicleTypes::MOTORCYCLE,
        VehicleTypesData::VAN => VehicleTypes::VAN,
    ];

    public static function fromRequestType(string $type): VehicleTypes
    {
        return self::MAP[strtolower($type)]
            ?? throw new InvalidArgumentException("Invalid vehicle type: $type");
    }
}
