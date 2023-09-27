<?php

namespace App\Actions\City;

use App\DataTransferObjects\CityData;
use App\Models\City;

class StoreCityAction
{
    public function execute(CityData $cityData)
    {
        return City::create(['name' => $cityData->name]);
    }
}
