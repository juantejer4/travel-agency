<?php

namespace App\Http\Requests;

use App\Http\DataTransferObjects\FlightData;
use Illuminate\Foundation\Http\FormRequest;

class UpsertFlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'airline_id' => ['required', 'exists:airlines,id'],
            'origin_city_id' => ['required', 'exists:cities,id'],
            'destination_city_id' => ['required', 'exists:cities,id', 'different:origin_city_id'],
            'departure_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'arrival_time' => ['required', 'date_format:Y-m-d\TH:i', 'after:departure_time']
        ];
    }
    public function toDto() : FlightData
    {
        return new FlightData(
            airline: $this->input('airline_id'),
            origin: $this->input('origin_city_id'),
            destination: $this->input('destination_city_id'),
            departureTime: $this->input('departure_time'),
            arrivalTime: $this->input('arrival_time')
        );
    }
}
