<?php

namespace App\Actions\Airline;

use App\DataTransferObjects\AirlineData;
use App\Models\Airline;
use App\Models\City;

class UpdateAirlineAction
{
    public function execute(Airline $airline, AirlineData $airlineData)
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
