<?php

namespace App\Http\ViewModels;

use App\Models\City;
use Spatie\ViewModels\ViewModel;

class CityViewModel extends ViewModel
{
    public function links()
    {
        return City::paginate()->links();
    }

    public function cities()
    {
        return City::withCount(['arrivingFlights', 'departingFlights'])->paginate();
    }
}
