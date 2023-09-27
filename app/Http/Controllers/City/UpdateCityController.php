<?php

namespace App\Http\Controllers\City;

use App\Http\Actions\UpdateCityAction;
use App\Http\Requests\UpsertCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class UpdateCityController
{
    public function __invoke(UpsertCityRequest $request, City $city, UpdateCityAction $action): JsonResponse
    {
        $cityData = $request->toDto();
        $updated = $action->execute($cityData, $city);
        return response()->json(['success' => $updated ? 'City updated' : 'Update failed']);
    }
}
