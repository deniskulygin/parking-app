<?php

namespace tests\Unit\Manager;

use App\Dict\VehicleTypes;
use App\Manager\VehicleManager;
use App\Models\Vehicle;
use App\Repository\VehicleRepository;
use Illuminate\Container\Container;
use Mockery;
use PHPUnit\Framework\TestCase;

class VehicleManagerTest extends TestCase
{
    private VehicleManager $vehicleManager;
    private $vehicleRepositoryMock;
    private $containerMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vehicleRepositoryMock = Mockery::mock(VehicleRepository::class);
        $this->containerMock = Mockery::mock(Container::class);

        $this->vehicleManager = new VehicleManager($this->containerMock, $this->vehicleRepositoryMock);
    }

    public function test_getOrCreate_should_return_existing_vehicle_if_found(): void
    {
        $vehicleType = VehicleTypes::CAR;
        $vehicle = Mockery::mock(Vehicle::class);

        $this->vehicleRepositoryMock->shouldReceive('findByType')
            ->once()
            ->with($vehicleType)
            ->andReturn($vehicle);

        $result = $this->vehicleManager->getOrCreate($vehicleType);

        $this->assertSame($vehicle, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
