<?php

namespace App\Http\Controllers\Flight;

use App\Http\Actions\UpdateFlightAction;
use App\Http\Requests\UpsertFlightRequest;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class UpdateFlightController
{
    public function __invoke(UpsertFlightRequest $request, Flight $flight, UpdateFlightAction $action): JsonResponse
    {
        $flightData = $request->toDto();
        $updated = $action->execute($flightData, $flight);
        return response()->json($updated);
    }
}
