<?php

declare(strict_types=1);

namespace App\Http\Request;

use App\Data\VehicleTypes;

class ParkVehicleRequest extends JsonFormRequest
{
    public function rules(): array
    {
        return [
            'type' => [
                'bail',
                'required',
                'string',
                'max:10',
                'in:' . VehicleTypes::getVehicleTypesAsString(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'type.string' => 'Field name must be a string',
            'type.required' => 'Field name is required',
            'type.max' => 'Field name cannot be longer than 10 characters',
        ];
    }

    public function getType(): string
    {
        return $this->json('type');
    }

    public function getParkingSpotId(): string
    {
        return $this->route('parkingSpotUuid');
    }
}
