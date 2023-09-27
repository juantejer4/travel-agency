<?php

namespace App\Http\Controllers\Flight;

use App\Actions\Flight\GetFlightsAction;
use App\Http\Requests\GetFlightRequest;
use Illuminate\Http\JsonResponse;

class GetFlightController
{
    public function __invoke(GetFlightRequest $request, GetFlightsAction $getFlightsAction): JsonResponse
    {
        $flights = $getFlightsAction->execute($request);

        $response['data'] = $flights;
        $response['links'] = strval($flights->links());

        return response()->json($response);
    }
}

