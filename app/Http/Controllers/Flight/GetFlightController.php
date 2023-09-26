<?php

namespace App\Http\Controllers\Flight;

use App\Models\Flight;
use App\Http\Requests\GetFlightRequest;
use Illuminate\Http\JsonResponse;

class GetFlightController
{
    public function __invoke(GetFlightRequest $request): JsonResponse
    {
    $flightData = $request->toDto();

    $query = Flight::with('origin', 'destination', 'airline');

    if (isset($flightData->sort) && isset($flightData->sortOrder)) {
        $query->orderBy($flightData->sort, $flightData->sortOrder);
    }

    if (isset($flightData->startDate)) {
        $query->where('departure_time', '>=', $flightData->startDate);
    }

    if (isset($flightData->endDate)) {
        $query->where('departure_time', '<=', $flightData->endDate);
    }

    $flights = $query->paginate();
    $response['data'] = $flights;
    $response['links'] = strval($flights->links());

    return response()->json($response);
    }
}

