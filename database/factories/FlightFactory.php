<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureTime = $this->faker->dateTimeBetween('now', '+1 month');
        $modifiedDepartureTime = clone $departureTime;
        $arrivalTime = $this->faker->dateTimeBetween($departureTime, $modifiedDepartureTime->modify('+6 hours'));

        return [
            'departure_time' => $departureTime,
            'arrival_time' => $arrivalTime,
            'airline_id' => Airline::factory(),
            'origin_city_id' => City::factory(),
            'destination_city_id' => City::factory()
        ];
    }
}
