<?php

namespace App\Http\Controllers\City;

use App\Http\Requests\UpsertCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class StoreCityController
{
    public function __invoke(UpsertCityRequest $request): JsonResponse
    {
        $city = City::create($request->validated());
        return response()->json($city);
    }
}
