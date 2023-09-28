<?php

namespace App\Http\Controllers\Airline;

use App\Actions\Airline\UpdateAirlineAction;
use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use App\Transformers\AirlineTransformer;
use Illuminate\Http\JsonResponse;

class UpdateAirlineController
{
    public function __invoke(UpdateAirlineRequest $request, Airline $airline, UpdateAirlineAction $updateAirlineAction): JsonResponse
    {
        $airlineData = $request->toDto();
        $updateAirlineAction->execute($airline, $airlineData);
        return responder()->success($airline, AirlineTransformer::class)->respond();
    }

}
