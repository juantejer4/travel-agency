<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertFlightRequest;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class StoreFlightController
{
    public function __invoke(UpsertFlightRequest $request): JsonResponse
    {
        $flights = Flight::create($request->validated());
        return response()->json($flights);
    }
}
