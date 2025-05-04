<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\QueryBuilder\ParkingLotQueryBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method int getId()
 * @method string getUniqueId()
 * @method $this setUniqueId(string $uniqueId)
 * @method string getName()
 * @method string getIsAvailable()
 * @method $this setName(string $name)
 * @method int getCreatedAt()
 * @method $this setCreatedAt(int $timestamp)
 * @method int|null getUpdatedAt()
 * @method $this setUpdatedAt(int $timestamp)
 *
 * @method static ParkingLotQueryBuilder query()
 */
class ParkingLot extends AbstractModel
{
    public const TABLE_NAME = 'parking_lots';

    protected function init(): void
    {
        $this->table = self::TABLE_NAME;
        $this->dateFormat = 'U';
        $this->casts = [
            'is_available' => 'boolean',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];
    }

    public function availableSpots(): HasMany
    {
        return $this->hasMany(ParkingSpot::class, 'parking_lot_id', 'id')
            ->where('is_occupied', false);
    }

    public function getAvailableSpotsCount(): int
    {
        return $this->availableSpots()->count();
    }

    public function newEloquentBuilder($query): ParkingLotQueryBuilder
    {
        return new ParkingLotQueryBuilder($query);
    }
}
