<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

abstract class AbstractModel extends Model
{
    public const UNIQUE_ID = 'unique_id';

    public function __construct(array $attributes = [])
    {
        $this->init();
        parent::__construct($attributes);
    }

    abstract protected function init(): void;

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function (AbstractModel $model) {
            $model->setUniqueIdOnCreate();
        });
    }

    protected function setUniqueIdOnCreate(): void
    {
        if (\is_string(static::UNIQUE_ID)) {
            $this->{static::UNIQUE_ID} = $this->generateUniqueString();
        }
    }

    /**
     * @throws \Exception
     * @throws \Exception
     */
    protected function generateUniqueString(): string
    {
        return str_replace('-', '', Uuid::uuid4()->toString()) . strtolower(bin2hex(random_bytes(4)));
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    /**
     * @return $this|mixed
     */
    public function __call($method, $parameters)
    {
        $methodPrefix = substr($method, 0, 3);
        if ($methodPrefix === 'get') {
            $methodSuffix = Str::snake(substr($method, 3));

            return $this->getAttribute($methodSuffix);
        }

        if ($methodPrefix === 'set') {
            $methodSuffix = Str::snake(substr($method, 3));
            $this->setAttribute($methodSuffix, ...$parameters);

            return $this;
        }

        return parent::__call($method, $parameters);
    }
}
