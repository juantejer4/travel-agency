<?php

use App\Http\Controllers\AirlineIndexController;
use App\Http\Controllers\CityIndexController;
use App\Http\Controllers\FlightIndexController;
use Illuminate\Support\Facades\Route;


Route::get('/cities', CityIndexController::class);

Route::get('/airlines', AirlineIndexController::class);

Route::get('/flights', FlightIndexController::class);