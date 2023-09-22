<?php

namespace App\Http\Controllers\Airline;

use App\Models\Airline;
use Illuminate\Http\JsonResponse;

class DeleteAirlineController
{
    public function __invoke(Airline $airline): JsonResponse
    {
        $airline->delete();
        return response()->json(['success' => 'Airline deleted']);
    }
}
