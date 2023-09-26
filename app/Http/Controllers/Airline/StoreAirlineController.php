<?php

namespace App\Http\Controllers\Airline;

use App\Http\Requests\CreateAirlineRequest;
use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class StoreAirlineController
{
    public function __invoke(CreateAirlineRequest $request): JsonResponse
    {
        $airlineData = $request->toDto();
        $airline = Airline::create([
            'name' => $airlineData->name,
            'description' => $airlineData->description
        ]);
        $cities = City::whereIn('name', $airlineData->cities)->get();
        $airline->cities()->attach($cities);

        return response()->json($airline);
    }
}
