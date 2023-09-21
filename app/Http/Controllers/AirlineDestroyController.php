<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\JsonResponse;

class AirlineDestroyController
{
    public function destroy(Airline $airline): JsonResponse
    {
        $airline->delete();
        return response()->json(['success' => 'Airline deleted']);
    }
}
