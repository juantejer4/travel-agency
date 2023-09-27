<?php

namespace App\DataTransferObjects;

class FlightData {

    public function __construct(public string $airline, public string $origin, public string $destination,
        public string $departureTime, public string $arrivalTime)
    {

    }
}
