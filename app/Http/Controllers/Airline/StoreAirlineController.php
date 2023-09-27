<?php

namespace App\Http\Controllers\Airline;

use App\Http\Actions\StoreAirlineAction;
use App\Http\Requests\CreateAirlineRequest;
use Illuminate\Http\JsonResponse;

class StoreAirlineController
{
    public function __invoke(CreateAirlineRequest $request, StoreAirlineAction $action): JsonResponse
    {
        $airlineData = $request->toDto();
        $airline = $action->execute($airlineData);
        return response()->json($airline);
    }
}
