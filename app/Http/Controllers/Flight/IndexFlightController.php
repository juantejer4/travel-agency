<?php

namespace App\Http\Controllers\Flight;

use App\Http\ViewModels\FlightViewModel;
use App\Models\Flight;
use Illuminate\Contracts\View\View;

class IndexFlightController
{
    public function __invoke(FlightViewModel $viewModel): View
    {
        return view('flights.show', $viewModel);
    }
}
