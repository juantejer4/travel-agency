<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAirlineRequest;
use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class StoreAirlineController
{
    public function __invoke(CreateAirlineRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $airline = Airline::create([
            'name' => $attributes['name'],
            'description' => $attributes['description']
        ]);

        if (isset($attributes['cities'])) {
            $cities = City::whereIn('name', $attributes['cities'])->get();
            $airline->cities()->attach($cities);
        }

        return response()->json($airline);
    }
}
