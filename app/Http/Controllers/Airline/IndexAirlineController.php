<?php

namespace App\Http\Controllers\Airline;

use App\Http\ViewModels\AirlineViewModel;
use App\Models\Airline;
use App\Models\City;
use Illuminate\View\View;

class IndexAirlineController
{
    public function __invoke(AirlineViewModel $viewModel): View
    {
        return view('airlines.show', $viewModel);
    }
}
