<?php

namespace App\Http\Controllers\City;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class DeleteCityController
{
    public function __invoke(City $city): JsonResponse
    {
        $city->delete();
        return response()->json(['success' => 'City deleted']);
    }
}
