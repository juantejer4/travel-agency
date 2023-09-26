<?php

namespace App\Http\Controllers\City;

use App\Http\Requests\UpsertCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class UpdateCityController
{
    public function __invoke(UpsertCityRequest $request, City $city): JsonResponse
    {
        $cityData = $request->toDto();
        $city->update(['name' => $cityData->name]);
        return response()->json(['success' => 'City updated']);
    }
}
