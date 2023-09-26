<?php

namespace App\Http\Controllers\Flight;

use App\Http\Requests\UpsertFlightRequest;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class StoreFlightController
{
    public function __invoke(UpsertFlightRequest $request): JsonResponse
    {
        $flightData = $request->toDto();

        $flights = Flight::create([
            'airline_id' => $flightData->airline,
            'origin_city_id' => $flightData->origin,
            'destination_city_id' => $flightData->destination,
            'departure_time' => $flightData->departureTime,
            'arrival_time' => $flightData->arrivalTime
        ]);

        return response()->json($flights);
    }

}
