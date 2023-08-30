<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cities = City::factory(10)->create();
        $airlines = Airline::factory(5)->create();

        foreach ($airlines as $airline) {
            // Relates every city with all or some airlines
            $airline->cities()->attach($cities->random(rand(0, $airlines->count())));
        }
        Flight::factory(3)->create();
    }
}
