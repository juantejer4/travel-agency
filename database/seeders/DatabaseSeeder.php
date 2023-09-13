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
        $airlines = Airline::factory()->count(20)->hasCities(2)->create();

        Flight::factory(20)->create();
    }
}
