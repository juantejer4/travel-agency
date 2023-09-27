<?php

namespace App\Http\Controllers\City;

use App\Actions\City\StoreCityAction;
use App\Http\Requests\UpsertCityRequest;
use Illuminate\Http\JsonResponse;

class StoreCityController
{
    public function __invoke(UpsertCityRequest $request, StoreCityAction $storeCityAction): JsonResponse
    {
        $cityData = $request->toDto();
        $city = $storeCityAction->execute($cityData);
        return response()->json($city);
    }
}
