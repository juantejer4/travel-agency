<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class FlightDestroyController
{
    public function __invoke(Flight $flight): JsonResponse
    {
        $flight->delete();
        return response()->json(['success' => 'Flight deleted']);
    }
}
