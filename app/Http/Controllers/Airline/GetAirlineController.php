<?php

namespace App\Http\Controllers\Airline;

use App\Http\ViewModels\AirlineViewModel;
use Illuminate\Http\JsonResponse;

class GetAirlineController
{
    public function __invoke(AirlineViewModel $viewModel): JsonResponse
    {
        return response()->json(['data' => $viewModel->airlines()]);
    }
}
