<?php

use App\Http\Controllers\AirlineIndexController;
use App\Http\Controllers\CityIndexController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;


Route::get('/cities', CityIndexController::class);

Route::get('/airlines', AirlineIndexController::class);

Route::get('/flights', [FlightController::class, 'index']);