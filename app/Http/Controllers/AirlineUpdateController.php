<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class AirlineUpdateController extends Controller
{
    public function update(UpdateAirlineRequest $request, Airline $airline): JsonResponse
    {
        $attributes = $request->validated();

        $airline->update([
            'name' => $attributes['name'],
            'description' => $attributes['description']
        ]);

        $cities = [];
        if (isset($attributes['cities'])) {
            $cities = City::whereIn('name', $attributes['cities'])->get();
        }
        $airline->cities()->sync($cities);

        return response()->json(['success' => 'City updated']);
    }
}
