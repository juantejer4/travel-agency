<?php

namespace App\Http\Controllers\Flight;

use App\Actions\Flight\GetFlightsAction;
use App\Http\Requests\GetFlightRequest;
use App\Transformers\FlightTransformer;
use Illuminate\Http\JsonResponse;

class GetFlightController
{
    public function __invoke(GetFlightRequest $request, GetFlightsAction $getFlightsAction): JsonResponse
    {
        $flights = $getFlightsAction->execute($request);

        return responder()->success($flights, FlightTransformer::class)
            ->meta(['links'=>strval($flights->links())])->respond();
    }
}

