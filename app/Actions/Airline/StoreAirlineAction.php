<?php

namespace App\Actions\Airline;

use App\DataTransferObjects\AirlineData;
use App\Models\Airline;
use App\Models\City;

class StoreAirlineAction
{
    public function execute(AirlineData $airlineData)
    {
        $airline = Airline::create([
            'name' => $airlineData->name,
            'description' => $airlineData->description
        ]);

        $cities = City::whereIn('name', $airlineData->cities)->get();
        $airline->cities()->attach($cities);

        return $airline;
    }
}
