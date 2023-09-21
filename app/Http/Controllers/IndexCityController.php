<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Contracts\View\View;

class IndexCityController
{
    public function __invoke(): View
    {
        return view('cities.show', [
            'links' => City::paginate()->links()
        ]);
    }
}
