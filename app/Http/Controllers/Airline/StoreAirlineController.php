<?php

namespace App\Http\Controllers\Airline;

use App\Actions\Airline\StoreAirlineAction;
use App\Http\Requests\CreateAirlineRequest;
use Illuminate\Http\JsonResponse;

class StoreAirlineController
{
    public function __invoke(CreateAirlineRequest $request, StoreAirlineAction $storeAirlineAction): JsonResponse
    {
        $airlineData = $request->toDto();
        $airline = $storeAirlineAction->execute($airlineData);
        return response()->json($airline);
    }
}
