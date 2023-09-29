<?php

namespace Tests\Feature;

use App\Actions\Flight\UpdateFlightAction;
use App\Http\Controllers\Flight\DeleteFlightController;
use App\Http\Controllers\Flight\GetFlightController;
use App\Http\Controllers\Flight\StoreFlightController;
use App\Http\Controllers\Flight\UpdateFlightController;
use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

it('gets flights for an airline ', function () {
    $origin = City::factory()->create();
    $destination = City::factory()->create();

    $airline = Airline::factory()->create();

    Flight::create([
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-05-05T14:30:00',
        'arrival_time' => '2023-05-05T14:31:00',
    ]);

    $this->json('GET', action(GetFlightController::class))
        ->assertSuccessful()
        ->assertJsonFragment([
            'airline' => $airline->name,
            'origin' => $origin->name,
            'destination' => $destination->name,
            'departure_time' => '2023-05-05T14:30:00',
            'arrival_time' => '2023-05-05T14:31:00',
        ]);
});

it('creates a flight with empty parameters', function () {
    City::factory(2)->create();
    Airline::factory()->create();

    $emptyAirlineData = [
        'airline_id' => NULL,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];

    $this->json('POST', action('App\Http\Controllers\Flight\StoreFlightController'), $emptyAirlineData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id');
    $emptyOriginData = [
        'airline_id' => 1,
        'origin_city_id' => NULL,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('POST', action(StoreFlightController::class), $emptyOriginData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id');

    $emptyDestinationData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => NULL,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('POST', action(StoreFlightController::class), $emptyDestinationData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');

    $emptyDepartureData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => NULL,
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('POST', action(StoreFlightController::class), $emptyDepartureData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('departure_time');

    $emptyArrivalData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T15:19',
        'arrival_time' => NULL
    ];
    $this->json('POST', action(StoreFlightController::class), $emptyArrivalData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('arrival_time');

    $emptyData = [
        'airline_id' => NULL,
        'origin_city_id' => NULL,
        'destination_city_id' => NULL,
        'departure_time' => NULL,
        'arrival_time' => NULL
    ];
    $this->json('POST', action(StoreFlightController::class), $emptyData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id')
        ->assertJsonValidationErrors('origin_city_id')
        ->assertJsonValidationErrors('destination_city_id')
        ->assertJsonValidationErrors('departure_time')
        ->assertJsonValidationErrors('arrival_time');
});

it('creates a flights with valid parameters', function (){
    City::factory(2)->create();
    Airline::factory()->create();

    $flightData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];

    $this->json('POST', action(StoreFlightController::class), $flightData)
        ->assertStatus(200)
        ->assertJson([
            'status' => 200,
            'success' => true,
            'data' => [
                'departure_time' => $flightData['departure_time'],
                'arrival_time' => $flightData['arrival_time'],
            ]
        ]);
});

it('tries to create a flight with invalid city id but fails', function () {
    City::factory()->create();
    Airline::factory()->create();

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => 999,
        'destination_city_id' => 1,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id');

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 999,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => -2,
        'destination_city_id' => 1,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id');

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => -2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => 999,
        'destination_city_id' => 789,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id')
        ->assertJsonValidationErrors('destination_city_id');
});

it('attempts to create a flight with same origin and destination but fails', function(){
    City::factory(2)->create();

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => 999,
        'destination_city_id' => 1,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id');

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => -31,
        'origin_city_id' => 999,
        'destination_city_id' => 1,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id');
});

it('tries to create a flight with departure time after arrival time but fails', function (){
    City::factory(2)->create();

    $this->json('POST', action(StoreFlightController::class), [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T19:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('arrival_time');
});

it('updates a flight with valid parameters', function(){
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

    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $flightData)
        ->assertStatus(200)
        ->assertJson([
            'status' => 200,
            'success' => true,
            'data' => [
                'success' => "Flight updated"
            ]
        ]);
});

it('updates a flight with invalid parameters', function(){
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
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidOrigin)
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id');


    $invalidDestination = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 999,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidDestination)
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');


    $invalidCities = [
        'airline_id' => 1,
        'origin_city_id' => 999,
        'destination_city_id' => -4,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidCities)
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id')
        ->assertJsonValidationErrors('destination_city_id');
});

it('updates a flight with same origin and destination', function (){
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
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $repeatedCities)
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');
});

it('tries to update a flight with invalid parameters', function(){
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
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidOrigin)
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id');


    $invalidDestination = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 999,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidDestination)
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');


    $invalidCities = [
        'airline_id' => 1,
        'origin_city_id' => 999,
        'destination_city_id' => -4,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidCities)
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id')
        ->assertJsonValidationErrors('destination_city_id');
});

it('updates a flight with invalid airline', function (){
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
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidAirline)
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id');
});

it('updates flight with departure time after arrival time', function(){
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
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $invalidTimes)
        ->assertStatus(422)
        ->assertJsonValidationErrors('arrival_time');
});

it('updates a flight with empty parameters', function(){
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
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $emptyAirline)
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id');

    $emptyOrigin = [
        'airline_id' => 1,
        'origin_city_id' => NULL,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T16:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $emptyOrigin)
        ->assertStatus(422)
        ->assertJsonValidationErrors('origin_city_id');

    $emptyDestination = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => NULL,
        'departure_time' => '2023-09-11T16:18',
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $emptyDestination)
        ->assertStatus(422)
        ->assertJsonValidationErrors('destination_city_id');

    $emptyDeparture = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => NULL,
        'arrival_time' => '2023-09-11T15:19'
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $emptyDeparture)
        ->assertStatus(422)
        ->assertJsonValidationErrors('departure_time');

    $emptyArrival = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T16:18',
        'arrival_time' => NULL
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $emptyArrival)
        ->assertStatus(422)
        ->assertJsonValidationErrors('arrival_time');

    $emptyData = [
        'airline_id' => NULL,
        'origin_city_id' => NULL,
        'destination_city_id' => NULL,
        'departure_time' => NULL,
        'arrival_time' => NULL
    ];
    $this->json('PUT', action(UpdateFlightController::class, ['flight' => $flight]), $emptyData)
        ->assertStatus(422)
        ->assertJsonValidationErrors('airline_id')
        ->assertJsonValidationErrors('origin_city_id')
        ->assertJsonValidationErrors('destination_city_id')
        ->assertJsonValidationErrors('departure_time')
        ->assertJsonValidationErrors('arrival_time');
});

it('deletes a flight correctly', function (){
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

    $this->json('DELETE', action(DeleteFlightController::class, ['flight' => $flight]))
        ->assertStatus(200);

    $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
});
