<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @method int getId()
 * @method string getUniqueId()
 * @method $this setUniqueId(string $uniqueId)
 * @method string getType()
 * @method $this setType(string $type)
 * @method int getCreatedAt()
 * @method $this setCreatedAt(int $timestamp)
 * @method int|null getUpdatedAt()
 * @method $this setUpdatedAt(int $timestamp)
 */
class Vehicle extends AbstractModel
{
    public const TABLE_NAME = 'vehicles';

    protected function init(): void
    {
        $this->table = self::TABLE_NAME;
        $this->casts = [
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];
    }
}
