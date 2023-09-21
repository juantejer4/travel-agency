<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertCityRequest;
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

    public function store(UpsertCityRequest $request): JsonResponse
    {
        $city = City::create($request->validated());
        return response()->json($city);
    }

    public function getCities(): JsonResponse
    {
        $cities = City::withCount(['arrivingFlights', 'departingFlights'])->paginate();

        $response['data'] = $cities;
        return response()->json($response);
    }


    public function update(UpsertCityRequest $request, City $city): JsonResponse
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