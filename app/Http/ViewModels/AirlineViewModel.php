<?php

namespace App\Http\ViewModels;

use App\Models\Airline;
use App\Models\City;
use Spatie\ViewModels\ViewModel;

class AirlineViewModel extends ViewModel
{
    public function airlines()
    {
        return Airline::with(['cities'])->withCount('incomingFlights')->paginate(15);
    }
    public function cities()
    {
        return City::all();
    }

    public function links()
    {
        return $this->airlines()->links();
    }

}
