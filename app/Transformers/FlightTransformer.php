<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;

class FlightTransformer extends Transformer
{
    public function transform($flight)
    {
        return [
            'id' => (int)$flight->id,
            'origin' => $flight->origin->name,
            'destination' => $flight->destination->name,
            'airline' => $flight->airline->name,
            'departure_time' => $flight->departure_time,
            'arrival_time' => $flight->arrival_time
        ];
    }
}
