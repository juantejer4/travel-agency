<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;

class AirlineTransformer extends Transformer
{
    public function transform($airline)
    {
        return [
            'id' => (int)$airline->id,
            'name' => $airline->name,
            'description' => $airline->description,
            'cities' => $airline->cities,
            'incoming_flights_count' => $airline->incomingFlights()->count()
        ];
    }
}
