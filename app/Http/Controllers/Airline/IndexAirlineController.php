<?php

namespace App\Http\Controllers\Airline;

use App\Models\Airline;
use App\Models\City;
use Illuminate\View\View;

class IndexAirlineController
{
    public function __invoke(): View
    {
        return view('airlines.show', [
            'links' => Airline::paginate()->links(),
            'cities' => City::all()
        ]);
    }
}
