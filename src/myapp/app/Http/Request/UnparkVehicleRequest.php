<?php

declare(strict_types=1);

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class UnparkVehicleRequest extends FormRequest
{
    public function getParkingSpotId(): string
    {
        return $this->route('parkingSpotUuid');
    }
}
