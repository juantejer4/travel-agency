<?php

namespace App\Http\Controllers\City;

use App\Actions\City\StoreCityAction;
use App\Http\Requests\UpsertCityRequest;
use App\Transformers\CityTransformer;
use Illuminate\Http\JsonResponse;

class StoreCityController
{
    public function __invoke(UpsertCityRequest $request, StoreCityAction $storeCityAction): JsonResponse
    {
        $cityData = $request->toDto();
        $city = $storeCityAction->execute($cityData);
        return responder()->success($city, CityTransformer::class)->respond();
    }
}
