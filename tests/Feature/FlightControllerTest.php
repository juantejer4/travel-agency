<?php

namespace Tests\Feature;

use App\Http\Controllers\Flight\DeleteFlightController;
use App\Http\Controllers\Flight\GetFlightController;
use App\Http\Controllers\Flight\StoreFlightController;
use App\Http\Controllers\Flight\UpdateFlightController;
use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('gets flights for an airline ', function () {
    $origin = City::factory()->create();
    $destination = City::factory()->create();

    $airline = Airline::factory()->create();

    Flight::factory()->create([
        'airline_id' => $airline->id,
        'origin_city_id' => $origin->id,
        'destination_city_id' => $destination->id,
    ]);

    $this->getJson(route('flights.get'))
        ->assertSuccessful()
        ->assertJsonFragment([
            'airline' => $airline->name,
            'origin' => $origin->name,
            'destination' => $destination->name
        ]);
});

it('creates a flight with empty parameters', function ($data, $errorKey) {
    City::factory(2)->create();
    Airline::factory()->create();

    $this->postJson(route('flights.store'), $data)
        ->assertUnprocessable()
        ->assertJsonValidationErrors($errorKey);
})->with(
    [
    'empty airline data' => [
        [
            'airline_id' => NULL
        ],
        'airline_id'
    ],
    'empty origin data' => [
        [
            'origin_city_id' => NULL
        ],
        'origin_city_id'
    ],
    'empty destination data' => [
        [
            'destination_city_id' => NULL
        ],
        'destination_city_id'
    ],
    'empty departure data' => [
        [
            'departure_time' => NULL
        ],
        'departure_time'
    ],
    'empty arrival data' => [
        [
            'departure_time' => NULL,
            'arrival_time' => NULL
        ],
        ['departure_time', 'arrival_time']
    ],
    'empty data' => [
        [
            'airline_id' => NULL,
            'origin_city_id' => NULL,
            'destination_city_id' => NULL,
            'departure_time' => NULL,
            'arrival_time' => NULL
        ],
        ['airline_id',
            'origin_city_id',
            'destination_city_id',
            'departure_time',
            'arrival_time']
    ]
]);

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

    $this->postJson(route('flights.store'), $flightData)
        ->assertOk()
        ->assertJson([
            'status' => 200,
            'success' => true,
            'data' => [
                'departure_time' => $flightData['departure_time'],
                'arrival_time' => $flightData['arrival_time'],
            ]
        ]);
});

it('tries to create a flight with invalid city id but fails', function ($data, $errorKey) {
    City::factory()->create();
    Airline::factory()->create();

    $this->postJson(route('flights.store'), $data)
        ->assertUnprocessable()
        ->assertJsonValidationErrors($errorKey);
})->with([
    'invalid origin city id' => [
        [
            'origin_city_id' => 999
        ],
        'origin_city_id'
    ],
    'invalid destination city id' => [
        [
            'destination_city_id' => 999
        ],
        'destination_city_id'
    ],
    'negative origin city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => -2
        ],
        'origin_city_id'
    ],
    'negative destination city id' => [
        [
            'destination_city_id' => -2
        ],
        ['destination_city_id']
    ],
    'invalid origin and destination city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 789
        ],
        ['origin_city_id', 'destination_city_id']
    ],
]);

it('attempts to create a flight with same origin and destination but fails', function(){
    City::factory(2)->create();

    $this->postJson(route('flights.store'), [
        'airline_id' => 1,
        'origin_city_id' => 2,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('destination_city_id');
});

it('tries to create a flight with departure time after arrival time but fails', function (){
    City::factory(2)->create();

    $this->postJson(route('flights.store'), [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T19:18',
        'arrival_time' => '2023-09-11T15:19'
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('arrival_time');
});

it('updates a flight with valid parameters', function(){
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

    $flightData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];

    $flight = Flight::factory()->create($flightData);

    $this->putJson(route('flights.update', ['flight' => $flight]), $flightData)
        ->assertOk()
        ->assertJson([
            'status' => 200,
            'success' => true,
            'data' => [
                'success' => "Flight updated"
            ]
        ]);
});

it('updates a flight with invalid parameters', function ($data, $errorKey) {
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

    $flightData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];

    $flight = Flight::factory()->create($flightData);

    $this->putJson(route('flights.update', ['flight' => $flight]), $data)
        ->assertUnprocessable()
        ->assertJsonValidationErrors($errorKey);

})->with([
    'invalid origin city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        'origin_city_id'
    ],
    'invalid destination city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 999,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        'destination_city_id'
    ],
    'invalid origin and destination city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => -4,
            'departure_time' => NULL,
            'arrival_time' => NULL
        ],
        ['origin_city_id',
            'destination_city_id']
    ],
]);

it('updates a flight with same origin and destination', function (){
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

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
    $this->putJson(route('flights.update', ['flight' => $flight]), $repeatedCities)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('destination_city_id');
});

it('tries to update a flight with invalid parameters', function ($data, $errorKey) {
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

    $flightData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];

    $flight = Flight::factory()->create($flightData);

    $this->putJson(route('flights.update', ['flight' => $flight]), $data)
        ->assertUnprocessable()
        ->assertJsonValidationErrors($errorKey);
})->with(
    [
    'invalid origin city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        'origin_city_id'
    ],
    'invalid destination city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 999,
            'departure_time' => '2023-09-11T11:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        'destination_city_id'
    ],
    'invalid origin and destination city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 999,
            'destination_city_id' => -4,
            'departure_time' => NULL,
            'arrival_time' => NULL
        ],
        ['origin_city_id',
            'destination_city_id']
    ],
]);

it('updates a flight with invalid airline', function (){
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

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
    $this->putJson(route('flights.update', ['flight' => $flight]), $invalidAirline)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('airline_id');
});

it('updates flight with departure time after arrival time', function(){
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

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
    $this->putJson(route('flights.update', ['flight' => $flight]), $invalidTimes)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('arrival_time');
});

it('updates a flight with empty parameters', function ($data, $errorKey) {
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

    $flightData = [
        'airline_id' => 1,
        'origin_city_id' => 1,
        'destination_city_id' => 2,
        'departure_time' => '2023-09-11T11:18',
        'arrival_time' => '2023-09-11T15:19'
    ];

    $flight = Flight::factory()->create($flightData);

    $this->putJson(route('flights.update', ['flight' => $flight]), $data)
        ->assertUnprocessable()
        ->assertJsonValidationErrors($errorKey);
})->with([
    'empty airline id' => [
        [
            'airline_id' => NULL,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        'airline_id'
    ],
    'empty origin city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => NULL,
            'destination_city_id' => 2,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        'origin_city_id'
    ],
    'empty destination city id' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => NULL,
            'departure_time' => '2023-09-11T16:18',
            'arrival_time' => '2023-09-11T15:19'
        ],
        ['destination_city_id']
    ],
    'empty departure time' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => NULL,
            'arrival_time' => '2023-09-11T15:19'
        ],
        ['departure_time']
    ],
    'empty arrival time' => [
        [
            'airline_id' => 1,
            'origin_city_id' => 1,
            'destination_city_id' => 2,
            'departure_time' => NULL,
            'arrival_time' => NULL
        ],
        ['departure_time',
            'arrival_time']
    ],
]);

it('deletes a flight correctly', function (){
    $cities = City::factory(2)->create();
    $airline = Airline::factory()->create();

    $cityIds = $cities->pluck('id')->toArray();
    $airline->cities()->attach($cityIds);

    $flight = Flight::factory()->create();

    $this->deleteJson(route('flights.delete', ['flight' => $flight]))
        ->assertOk();

    $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
});
