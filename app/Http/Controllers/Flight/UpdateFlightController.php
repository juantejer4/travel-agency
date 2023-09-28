<?php

namespace App\Http\Controllers\Flight;

use App\Actions\Flight\UpdateFlightAction;
use App\Http\Requests\UpsertFlightRequest;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class UpdateFlightController
{
    public function __invoke(UpsertFlightRequest $request, Flight $flight, UpdateFlightAction $updateFlightAction): JsonResponse
    {
        $flightData = $request->toDto();
        $updateFlightAction->execute($flight, $flightData);
        return responder()->success(['success' => 'Flight updated'])->respond();
    }
}

