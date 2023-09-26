<?php

namespace App\Http\Controllers\City;

use App\Http\Requests\UpsertCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class StoreCityController
{
    public function __invoke(UpsertCityRequest $request): JsonResponse
    {
        $cityData = $request->toDto();
        $city = City::create(['name' => $cityData->name]);
        return response()->json($city);
    }
}
