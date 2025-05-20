<?php

namespace Tests\Unit\Mapper;

use App\Dict\VehicleTypes;
use App\Data\VehicleTypes as VehicleTypesData;
use App\Mapper\VehicleTypeMapper;
use InvalidArgumentException;
use Tests\TestCase;

class VehicleTypeMapperTest extends TestCase
{
    public function test_from_request_type_maps_valid_types(): void
    {
        $this->assertSame(VehicleTypes::CAR, VehicleTypeMapper::fromRequestType(VehicleTypesData::CAR));
        $this->assertSame(VehicleTypes::MOTORCYCLE, VehicleTypeMapper::fromRequestType(VehicleTypesData::MOTORCYCLE));
        $this->assertSame(VehicleTypes::VAN, VehicleTypeMapper::fromRequestType(VehicleTypesData::VAN));

        $this->assertSame(VehicleTypes::CAR, VehicleTypeMapper::fromRequestType('CAR'));
    }

    public function test_from_request_type_throws_on_invalid_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid vehicle type: bike');

        VehicleTypeMapper::fromRequestType('bike');
    }

}
