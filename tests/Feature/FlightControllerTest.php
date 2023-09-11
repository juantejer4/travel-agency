<?php

namespace Tests\Feature;

use App\Http\Controllers\FlightController;
use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testGetFlightsForAnAirline()
    {
        City::factory(2)->create();

        Airline::factory()->create();

        $flight = Flight::create([
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-05-05T14:30:00',
            'arrival_time' => '2023-05-05T14:31:00',
        ]);

        $this->json('GET', action([FlightController::class, 'getFlights']))
            ->assertSuccessful()
            ->assertJsonFragment([
                'airline_id' => 1,
                'origin_city_id' => 1,
                'destination_city_id' => 2,
                'departure_time' => '2023-05-05T14:30:00',
                'arrival_time' => '2023-05-05T14:31:00',
            ]);
    }
}
