<?php

namespace App\Http\Controllers\Flight;

use App\Http\Actions\StoreFlightAction;
use App\Http\Requests\UpsertFlightRequest;
use Illuminate\Http\JsonResponse;

class StoreFlightController
{
    public function __invoke(UpsertFlightRequest $request, StoreFlightAction $action): JsonResponse
    {
        $flightData = $request->toDto();
        $flights = $action->execute($flightData);
        return response()->json($flights);
    }
}
