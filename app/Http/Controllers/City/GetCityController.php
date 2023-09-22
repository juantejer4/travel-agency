<?php

namespace App\Http\Controllers\City;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class GetCityController
{
    public function __invoke(): JsonResponse
    {
        $cities = City::withCount(['arrivingFlights', 'departingFlights'])->paginate();

        $response['data'] = $cities;
        return response()->json($response);
    }
}
