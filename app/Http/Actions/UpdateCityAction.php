<?php

namespace App\Http\Actions;

use App\Http\DataTransferObjects\CityData;
use App\Models\City;

class UpdateCityAction
{
    public function execute(CityData $cityData, City $city)
    {
        return $city->update(['name' => $cityData->name]);
    }
}
