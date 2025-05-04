<?php

declare(strict_types=1);

namespace App\Http\Request;

use App\Exception\ApiException;
use Illuminate\Foundation\Http\FormRequest;

class JsonFormRequest extends FormRequest
{
    /**
     * @throws ApiException
     */
    public function validationData()
    {
        $requestData = [];
        $originalRequestData = $this->getContent();

        if (is_string($originalRequestData)) {
            $requestData = json_decode($originalRequestData, true);
        }

        if (empty($requestData)) {
            throw new ApiException('Invalid Payload');
        }

        return $requestData;
    }
}
