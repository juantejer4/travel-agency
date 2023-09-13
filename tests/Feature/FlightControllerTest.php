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

        Flight::create([
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

    /** @test */
    public function testCreateAFlightWithEmptyParameters()
    {
        City::factory(2)->create();
        Airline::factory()->create();

        $emptyAirlineData = [
            'airline_id' => NULL,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('POST', action([FlightController::class, 'store']), $emptyAirlineData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id');

        $emptyOriginData = [
            'airline_id' => 1,
            'origin_city_id' => NULL,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('POST', action([FlightController::class, 'store']), $emptyOriginData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id');

        $emptyDestinationData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => NULL,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('POST', action([FlightController::class, 'store']), $emptyDestinationData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('destination_city_id');

        $emptyDepartureData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => NULL,
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('POST', action([FlightController::class, 'store']), $emptyDepartureData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('departure_time');

        $emptyArrivalData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T15:19',
            'arrival_time' => NULL
        ];
        $this->json('POST', action([FlightController::class, 'store']), $emptyArrivalData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('arrival_time');

        $emptyData = [
            'airline_id' => NULL,
            'origin_city_id' => NULL,
            'destination_city_id' => NULL,
            'departure_time' => NULL,
            'arrival_time' => NULL
        ];
        $this->json('POST', action([FlightController::class, 'store']), $emptyData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id')
            ->assertJsonValidationErrors('origin_city_id')
            ->assertJsonValidationErrors('destination_city_id')
            ->assertJsonValidationErrors('departure_time')
            ->assertJsonValidationErrors('arrival_time');
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
    public function testCreateAFlightWithSameOriginAndDestination()
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
            ->assertJsonValidationErrors('destination_city_id');
    }

    //** @test */
    public function testCreateAFlightWithInvalidAirline()
    {
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

    /** @test */
    public function testUpdateAFlightWithValidParameters()
    {
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();

        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $flight = Flight::factory()->create($flightData);

        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $flightData)
            ->assertStatus(200)
            ->assertJson($flightData);
    }

    /** @test */
    public function testUpdateAFlightWithInvalidCityId()
    {
        
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();

        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $flight = Flight::factory()->create($flightData);

        $invalidOrigin = [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $invalidOrigin)
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id');


        $invalidDestination = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 999,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $invalidDestination)
            ->assertStatus(422)
            ->assertJsonValidationErrors('destination_city_id');


        $invalidCities = [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => -4,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $invalidCities)
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id')
            ->assertJsonValidationErrors('destination_city_id');
    }

    //** @test */
    public function testUpdateFlightSameOriginAndDestination()
    {
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();

        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $flight = Flight::factory()->create($flightData);

        $repeatedCities = [
            'airline_id' => 1,
            'origin_city_id' => 2,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $repeatedCities)
            ->assertStatus(422)
            ->assertJsonValidationErrors('destination_city_id');
    }

    //** @test */
    public function testUpdateAFlightWithInvalidAirline()
    {
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();

        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $flight = Flight::factory()->create($flightData);

        $invalidAirline = [
            'airline_id' => -5,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $invalidAirline)
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id');
    }

    //** @test */
    public function testEditFlightWithDepartureTimeAfterArrivalTime()
    {
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();

        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $flight = Flight::factory()->create($flightData);

        $invalidTimes = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $invalidTimes)
            ->assertStatus(422)
            ->assertJsonValidationErrors('arrival_time');
    }

    /** @test */
    public function testEditFlightWithEmptyParameters()
    {
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();
        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }
        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $flight = Flight::factory()->create($flightData);

        $emptyAirline = [
            'airline_id' => NULL,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $emptyAirline)
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id');

        $emptyOrigin = [
            'airline_id' => 1,
            'origin_city_id' => NULL,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $emptyOrigin)
            ->assertStatus(422)
            ->assertJsonValidationErrors('origin_city_id');

        $emptyDestiantion = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => NULL,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $emptyDestiantion)
            ->assertStatus(422)
            ->assertJsonValidationErrors('destination_city_id');

        $emptyDeparture = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => NULL,
            'arrival_time' => '2023-09-11T15:19'
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $emptyDeparture)
            ->assertStatus(422)
            ->assertJsonValidationErrors('departure_time');

        $emptyArrival = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => NULL
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $emptyArrival)
            ->assertStatus(422)
            ->assertJsonValidationErrors('arrival_time');

        $emptyData = [
            'airline_id' => NULL,
            'origin_city_id' => NULL,
            'destination_city_id' => NULL,
            'departure_time' => NULL,
            'arrival_time' => NULL
        ];
        $this->json('PUT', action([FlightController::class, 'update'], ['flight' => $flight]), $emptyData)
            ->assertStatus(422)
            ->assertJsonValidationErrors('airline_id')
            ->assertJsonValidationErrors('origin_city_id')
            ->assertJsonValidationErrors('destination_city_id')
            ->assertJsonValidationErrors('departure_time')
            ->assertJsonValidationErrors('arrival_time');
    }
    /** @test */
    public function testDeleteAFlight()
    {
        $cities = City::factory(2)->create();
        $airline = Airline::factory()->create();

        foreach ($cities as $city) {
            $airline->cities()->attach($city->id);
        }

        $flightData = [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ];

        $flight = Flight::factory()->create($flightData);

        $this->json('DELETE', action([FlightController::class, 'destroy'], ['flight' => $flight]))
            ->assertStatus(200);

        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }
}
