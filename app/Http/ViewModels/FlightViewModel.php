<?php

namespace App\Http\ViewModels;

use App\Models\Flight;
use Spatie\ViewModels\ViewModel;

class FlightViewModel extends ViewModel
{
    public function links(): string
    {
        return strval(Flight::paginate()->links());
    }
}

