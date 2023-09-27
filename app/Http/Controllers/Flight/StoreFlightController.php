<?php

namespace App\Http\Controllers\Flight;

use App\Actions\Flight\StoreFlightAction;
use App\Http\Requests\UpsertFlightRequest;
use Illuminate\Http\JsonResponse;

class StoreFlightController
{
    public function __invoke(UpsertFlightRequest $request, StoreFlightAction $storeFlightAction): JsonResponse
    {
        $flightData = $request->toDto();
        $flights = $storeFlightAction->execute($flightData);
        return response()->json($flights);
    }
}
