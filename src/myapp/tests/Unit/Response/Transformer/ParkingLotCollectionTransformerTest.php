<?php

use App\Http\Response\Transformer\ParkingLotCollectionTransformer;
use App\Models\ParkingLot;
use Tests\TestCase;

class ParkingLotCollectionTransformerTest extends TestCase
{
    private ParkingLotCollectionTransformer $transformer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transformer = new ParkingLotCollectionTransformer();
    }

    public function test_transform_should_return_correct_data_structure(): void
    {
        $parkingLot = Mockery::mock(ParkingLot::class);

        $parkingLot->shouldReceive('getUniqueId')->andReturn('123');
        $parkingLot->shouldReceive('getName')->andReturn('Main Parking Lot');
        $parkingLot->shouldReceive('getAvailableSpotsCount')->andReturn(50);
        $parkingLot->shouldReceive('getCreatedAt')->andReturn('2025-01-01 10:00:00');
        $parkingLot->shouldReceive('getUpdatedAt')->andReturn('2025-01-01 12:00:00');

        $result = $this->transformer->transform($parkingLot);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('spots_available', $result);
        $this->assertArrayHasKey('created_at', $result);
        $this->assertArrayHasKey('updated_at', $result);

        $this->assertEquals('123', $result['id']);
        $this->assertEquals('Main Parking Lot', $result['name']);
        $this->assertEquals(50, $result['spots_available']);
        $this->assertEquals('2025-01-01 10:00:00', $result['created_at']);
        $this->assertEquals('2025-01-01 12:00:00', $result['updated_at']);
    }
}
