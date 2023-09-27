<?php

namespace App\Http\Controllers\City;

use App\Http\Actions\StoreCityAction;
use App\Http\Requests\UpsertCityRequest;
use Illuminate\Http\JsonResponse;

class StoreCityController
{
    public function __invoke(UpsertCityRequest $request, StoreCityAction $action): JsonResponse
    {
        $cityData = $request->toDto();
        $city = $action->execute($cityData);
        return response()->json($city);
    }
}
