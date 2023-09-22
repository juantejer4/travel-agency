<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class GetCityController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $cities = City::withCount(['arrivingFlights', 'departingFlights'])->paginate();

        $response['data'] = $cities;
        return response()->json($response);
    }
}
