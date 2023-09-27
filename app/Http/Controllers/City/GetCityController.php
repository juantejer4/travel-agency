<?php

namespace App\Http\Controllers\City;

use App\Http\ViewModels\CityViewModel;
use Illuminate\Http\JsonResponse;

class GetCityController
{
    public function __invoke(CityViewModel $viewModel): JsonResponse
    {
        return response()->json(['data' => $viewModel->cities()]);
    }

}
