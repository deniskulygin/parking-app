<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Request\ListRequest;
use App\Http\Response\ResponseFactory;
use App\Http\Response\Transformer\ParkingLotCollectionTransformer;
use App\Models\ParkingLot;
use Illuminate\Http\Response;

class GetParkingLotController
{
    public function __construct(private readonly ResponseFactory $responseFactory)
    {
    }

    public function __invoke(ListRequest $request): Response
    {
        $parkingLost = ParkingLot::query()->getAllAvailable();

        return $this->responseFactory->collection(
            $parkingLost->paginate($request->getPerPage()),
            new ParkingLotCollectionTransformer()
        );
    }
}
