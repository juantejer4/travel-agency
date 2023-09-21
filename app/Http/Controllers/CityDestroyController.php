<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityDestroyController extends Controller
{
    public function __invoke(City $city): JsonResponse
    {
        $city->delete();
        return response()->json(['success' => 'City deleted']);
    }
}
