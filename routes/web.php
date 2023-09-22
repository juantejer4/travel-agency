<?php

use App\Http\Controllers\Airline\IndexAirlineController;
use App\Http\Controllers\City\IndexCityController;
use App\Http\Controllers\Flight\IndexFlightController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', IndexCityController::class);
Route::get('/airlines', IndexAirlineController::class);
Route::get('/flights', IndexFlightController::class);