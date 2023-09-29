<?php

namespace App\Http\Controllers\City;

use App\Http\ViewModels\CityViewModel;
use App\Models\City;
use App\Transformers\CityTransformer;
use Illuminate\Http\JsonResponse;

class GetCitiesController
{
    public function __invoke(): JsonResponse
    {
        $cities = City::withCount(['arrivingFlights', 'departingFlights'])->paginate();
        return responder()->success($cities, CityTransformer::class)->respond();
    }
}
