<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @method int getId()
 * @method string getUniqueId()
 * @method $this setUniqueId(string $uniqueId)
 * @method int getVehicleId()
 * @method $this setVehicleId(int $id)
 * @method int getParkingSpotId()
 * @method $this setParkingSpotId(int $id)
 * @method bool isUnparked()
 * @method $this setUnparked(bool $status)
 * @method int getCreatedAt()
 * @method $this setCreatedAt(int $timestamp)
 * @method int|null getUpdatedAt()
 * @method $this setUpdatedAt(int $timestamp)
 */
class Parking extends AbstractModel
{
    public const TABLE_NAME = 'parkings';

    protected function init(): void
    {
        $this->table = self::TABLE_NAME;
        $this->dateFormat = 'U';
        $this->casts = [
            'unparked' => 'boolean',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];
    }
}
