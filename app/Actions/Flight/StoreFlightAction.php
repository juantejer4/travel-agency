<?php

namespace App\Actions\Flight;

use App\DataTransferObjects\FlightData;
use App\Models\Flight;

class StoreFlightAction
{
    public function execute(FlightData $flightData)
    {
        return Flight::create([
            'airline_id' => $flightData->airline,
            'origin_city_id' => $flightData->origin,
            'destination_city_id' => $flightData->destination,
            'departure_time' => $flightData->departureTime,
            'arrival_time' => $flightData->arrivalTime
        ]);
    }
}
