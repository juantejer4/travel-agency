<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityStoreController
{
    public function __invoke(UpsertCityRequest $request): JsonResponse
    {
        $city = City::create($request->validated());
        return response()->json($city);
    }
}
