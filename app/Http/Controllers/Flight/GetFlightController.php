<?php

namespace App\Http\Controllers\Flight;

use App\Http\Actions\GetFlightsAction;
use App\Models\Flight;
use App\Http\Requests\GetFlightRequest;
use Illuminate\Http\JsonResponse;

class GetFlightController
{
    public function __invoke(GetFlightRequest $request, GetFlightsAction $action): JsonResponse
    {
        $flights = $action->execute($request);

        $response['data'] = $flights;
        $response['links'] = strval($flights->links());

        return response()->json($response);
    }
}

