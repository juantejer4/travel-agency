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
        $updated = $updateCityAction->execute($city, $cityData);
        return response()->json(['success' => $updated ? 'City updated' : 'Update failed']);
    }
}
