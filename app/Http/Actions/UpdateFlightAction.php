<?php

namespace App\Http\Actions;

use App\Http\DataTransferObjects\FlightData;
use App\Models\Flight;

class UpdateFlightAction
{
    public function execute(FlightData $flightData, Flight $flight)
    {
        return $flight->update([
            'airline_id' => $flightData->airline,
            'origin_city_id' => $flightData->origin,
            'destination_city_id' => $flightData->destination,
            'departure_time' => $flightData->departureTime,
            'arrival_time' => $flightData->arrivalTime
        ]);
    }
}
