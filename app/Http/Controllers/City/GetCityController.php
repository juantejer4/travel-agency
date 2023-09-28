<?php

namespace App\Http\Controllers\City;

use App\Http\ViewModels\CityViewModel;
use App\Transformers\CityTransformer;
use Illuminate\Http\JsonResponse;

class GetCityController
{
    public function __invoke(CityViewModel $viewModel): JsonResponse
    {
        return responder()->success($viewModel->cities(), CityTransformer::class)->respond();
    }
}
