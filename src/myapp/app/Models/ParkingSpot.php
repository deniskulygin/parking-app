<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @method int getId()
 * @method string getUniqueId()
 * @method $this setUniqueId(string $uniqueId)
 * @method int getParkingLotId()
 * @method $this setParkingLotId(int $id)
 * @method bool getIsOccupied()
 * @method $this setIsOccupied(bool $status)
 * @method int getCreatedAt()
 * @method $this setCreatedAt(int $timestamp)
 * @method int|null getUpdatedAt()
 * @method $this setUpdatedAt(int $timestamp)
 */
class ParkingSpot extends AbstractModel
{
    public const TABLE_NAME = 'parking_spots';

    protected function init(): void
    {
        $this->table = self::TABLE_NAME;
        $this->casts = [
            'is_occupied' => 'boolean',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];
    }
}
