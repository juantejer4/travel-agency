<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController
{
    public function index(): View
    {
        return view('cities.show', [
            'links' => City::paginate()->links()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $attributes = $request->validate([
            'name' => ['required', 'unique:cities']
        ]);
        $city = City::create($attributes);
        return response()->json($city);
    }

    public function getCities(): JsonResponse
    {
        $cities = City::paginate();
        $response['data'] = $cities;
        return response()->json($response);
    }

    public function update(Request $request, City $city): JsonResponse
    {
        $city->update($request->validate([
            'name' => ['required', 'unique:cities']
        ]));
        return response()->json(['success' => 'City updated']);
    }

    public function destroy(City $city): JsonResponse
    {
        $city->delete();
        return response()->json(['success' => 'City deleted']);
    }

    public function getCityById(City $city) : JsonResponse {
        return response()->json([
            'id' => $city->id,
            'name' => $city->name
        ]);
    }
}
