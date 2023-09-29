<?php

namespace App\Http\Controllers\Airline;

use App\Models\Airline;
use App\Transformers\AirlineTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetAirlineController
{
    public function __invoke(Request $request): JsonResponse
    {
        $airlines = Airline::with(['cities'])
            ->withCount('incomingFlights')
            ->paginate(intval($request->get('per_page', 15)));
        return responder()->success($airlines, AirlineTransformer::class)->respond();
    }
}
