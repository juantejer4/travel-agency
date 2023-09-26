<?php

namespace App\Http\Controllers\Airline;

use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class UpdateAirlineController
{
    public function __invoke(UpdateAirlineRequest $request, Airline $airline): JsonResponse
    {
        $airlineData = $request->toDto();
        $airline->update([
            'name' => $airlineData->name,
            'description' => $airlineData->description
        ]);

        $cityNames = $airlineData->cities;
        $cityIds = City::whereIn('name', $cityNames)->pluck('id');
        $airline->cities()->sync($cityIds);

        return response()->json(['success' => 'City updated']);
    }

}
