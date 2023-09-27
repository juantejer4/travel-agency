<?php

namespace App\Http\Actions;

use App\Http\DataTransferObjects\AirlineData;
use App\Models\Airline;
use App\Models\City;

class UpdateAirlineAction
{
    public function execute(AirlineData $airlineData, Airline $airline)
    {
        $airline->update([
            'name' => $airlineData->name,
            'description' => $airlineData->description
        ]);

        $cityNames = $airlineData->cities;
        $cityIds = City::whereIn('name', $cityNames)->pluck('id');
        $airline->cities()->sync($cityIds);

        return $airline;
    }
}
