<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use Illuminate\View\View;

class AirlineIndexController
{
    public function index(): View
    {
        return view('airlines.show', [
            'links' => Airline::paginate()->links(),
            'cities' => City::all()
        ]);
    }
}
