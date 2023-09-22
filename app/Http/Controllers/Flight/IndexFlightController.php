<?php

namespace App\Http\Controllers\Flight;

use App\Models\Flight;
use Illuminate\Contracts\View\View;

class IndexFlightController
{
    public function __invoke(): View
    {
        return view('flights.show', [
            'links' => Flight::paginate()->links()
        ]);
    }
}
