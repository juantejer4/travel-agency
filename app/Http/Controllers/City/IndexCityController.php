<?php

namespace App\Http\Controllers\City;

use App\Http\ViewModels\CityViewModel;
use Illuminate\Contracts\View\View;

class IndexCityController
{
    public function __invoke(CityViewModel $viewModel): View
    {
        return view('cities.show', $viewModel);
    }

}
