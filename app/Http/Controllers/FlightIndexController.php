<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Contracts\View\View;

class FlightIndexController
{
    public function __invoke(): View
    {
        return view('flights.show', [
            'links' => Flight::paginate()->links()
        ]);
    }
}
