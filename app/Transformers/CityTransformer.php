<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;

class CityTransformer extends Transformer
{
    public function transform($city)
    {
        return [
            'id' => $city->id,
            'name' => $city->name,
            'arriving_flights_count' => $city->arrivingFlights()->count(),
            'departing_flights_count' => $city->departingFlights()->count()
        ];
    }
}
