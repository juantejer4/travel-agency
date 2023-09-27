<?php

namespace App\Http\Actions;

use App\Http\DataTransferObjects\CityData;
use App\Models\City;

class StoreCityAction
{
    public function execute(CityData $cityData)
    {
        return City::create(['name' => $cityData->name]);
    }
}
