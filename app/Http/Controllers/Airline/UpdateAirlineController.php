<?php

namespace App\Http\Controllers\Airline;

use App\Http\Actions\UpdateAirlineAction;
use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use Illuminate\Http\JsonResponse;

class UpdateAirlineController
{
    public function __invoke(UpdateAirlineRequest $request, Airline $airline, UpdateAirlineAction $action): JsonResponse
    {
        $airlineData = $request->toDto();
        $action->execute($airlineData, $airline);
        return response()->json(['success' => 'City updated']);
    }
}
