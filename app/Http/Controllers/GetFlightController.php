<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Http\Requests\GetFlightRequest;
use Illuminate\Http\JsonResponse;

class GetFlightController
{
    public function __invoke(GetFlightRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $query = Flight::with('origin', 'destination', 'airline');

        if (isset($validated['sort']) && isset($validated['sortOrder'])) {
            $query->orderBy($validated['sort'], $validated['sortOrder']);
        }

        if (isset($validated['start_date'])) {
            $query->where('departure_time', '>=', $validated['start_date']);
        }

        if (isset($validated['end_date'])) {
            $query->where('departure_time', '<=', $validated['end_date']);
        }

        $flights = $query->paginate();
        $response['data'] = $flights;
        $response['links'] = strval($flights->links());

        return response()->json($response);
    }
}