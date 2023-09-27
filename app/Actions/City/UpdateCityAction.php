<?php

namespace App\Actions\City;

use App\DataTransferObjects\CityData;
use App\Models\City;

class UpdateCityAction
{
    public function execute(City $city, CityData $cityData)
    {
        return $city->update(['name' => $cityData->name]);
    }
}
