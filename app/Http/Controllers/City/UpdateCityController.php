<?php

namespace App\Http\Controllers\City;

use App\Actions\City\UpdateCityAction;
use App\Http\Requests\UpsertCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class UpdateCityController
{
    public function __invoke(UpsertCityRequest $request, City $city, UpdateCityAction $updateCityAction): JsonResponse
    {
        $cityData = $request->toDto();
        $updateCityAction->execute($city, $cityData);
        return responder()->success(['success' => 'City updated'])->respond();
    }
}
