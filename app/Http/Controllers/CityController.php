<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CityController
{
    public function index(): View
    {
        return view('cities.show', [
            'links' => City::paginate()->links()
        ]);
    }

    public function store(CityRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $city = City::create($attributes);
        return response()->json($city);
    }

    public function getCities(): JsonResponse
    {
        $cities = City::withCount(['arrivingFlights', 'departingFlights'])->paginate();

        $response['data'] = $cities;
        return response()->json($response);
    }


    public function update(CityRequest $request, City $city): JsonResponse
    {
        $city->update($request->validated());
        return response()->json(['success' => 'City updated']);
    }

    public function destroy(City $city): JsonResponse
    {
        $city->delete();
        return response()->json(['success' => 'City deleted']);
    }
}