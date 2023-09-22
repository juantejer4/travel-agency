<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertFlightRequest;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class UpdateFlightController
{
    public function __invoke(UpsertFlightRequest $request, Flight $flight): JsonResponse
    {
        $flight->update($request->validated());
        return response()->json($flight);
    }
}
