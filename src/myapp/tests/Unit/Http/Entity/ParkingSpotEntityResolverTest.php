<?php

use App\Exceptions\ApiErrorCode;
use App\Exceptions\ApiErrorMessage;
use App\Exceptions\ApiException;
use App\Http\Entity\ParkingSpotEntityResolver;
use App\Models\ParkingSpot;
use App\Repository\ParkingSpotRepository;
use PHPUnit\Framework\TestCase;

class ParkingSpotEntityResolverTest extends TestCase
{
    public function testRetrieveEntityReturnsParkingSpot(): void
    {
        $uniqueId = 'abc123';
        $mockSpot = $this->createMock(ParkingSpot::class);

        $repository = $this->createMock(ParkingSpotRepository::class);
        $repository->expects($this->once())
            ->method('findByUniqueId')
            ->with($uniqueId)
            ->willReturn($mockSpot);

        $resolver = new ParkingSpotEntityResolver($repository);
        $result = $resolver->retrieveEntity($uniqueId);

        $this->assertSame($mockSpot, $result);

        // Test caching works — second call shouldn't hit repository
        $result2 = $resolver->retrieveEntity($uniqueId);
        $this->assertSame($mockSpot, $result2);
    }

    public function testRetrieveEntityThrowsIfNotFound(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage(ApiErrorMessage::PARKING_SPOT_NOT_FOUND);
        $this->expectExceptionCode(ApiErrorCode::PARKING_SPOT_NOT_FOUND);

        $repository = $this->createMock(ParkingSpotRepository::class);
        $repository->expects($this->once())
            ->method('findByUniqueId')
            ->willReturn(null);

        $resolver = new ParkingSpotEntityResolver($repository);
        $resolver->retrieveEntity('nonexistent-id');
    }
}
