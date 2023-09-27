<?php

namespace App\Http\Controllers\Airline;

use App\Actions\Airline\UpdateAirlineAction;
use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use Illuminate\Http\JsonResponse;

class UpdateAirlineController
{
    public function __invoke(UpdateAirlineRequest $request, Airline $airline, UpdateAirlineAction $updateAirlineAction): JsonResponse
    {
        $airlineData = $request->toDto();
        $updateAirlineAction->execute($airline, $airlineData);
        return response()->json(['success' => 'City updated']);
    }
}
