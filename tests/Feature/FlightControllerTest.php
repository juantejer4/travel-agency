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

    /** @test */
    public function testCreateAFlightWithValidParameters()
    {
        City::factory(2)->create();
        Airline::factory()->create();

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $this->json('POST', action([FlightController::class, 'store']), $flightData)
            ->assertStatus(200)
            ->assertJson($flightData);
    }

    //** @test */
    public function testCreateAFlightWithInvalidCityId()
    {
        $this->withoutExceptionHandling();

        City::factory()->create();
        Airline::factory()->create();

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 1,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id');

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 999,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('destination_city_id');

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => -2,
            'destination_city_id' => 1,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id');

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => -2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('destination_city_id');

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 789,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id')
            ->assertJsonValidationErrors('destination_city_id');
    }

    //** @test */
    public function testCreatAFlightWithSameOriginAndDestination()
    {
        City::factory(2)->create();
        Airline::factory()->create();

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 1,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $this->json('POST', action([FlightController::class, 'store']), $flightData)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'destination_city_id' => 'The selected destination city id is invalid.'
            ]);
    }

    //** @test */
    public function testCreateAFlightWithInvalidAirline()
    {
        $this->withoutExceptionHandling();

        City::factory(2)->create();

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 1,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id');

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => -31,
            'origin_city_id' => 999,
            'destination_city_id' => 1,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id');
    }

    //** @test */
    public function testCreateFlightWithDepartureTimeAfterArrivalTime()
    {
        $this->withoutExceptionHandling();

        City::factory(2)->create();

        $this->json('POST', action([FlightController::class, 'store']), [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T19:18',
            'arrival_time' => '2023-09-11T15:19'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('arrival_time');
    }

}
