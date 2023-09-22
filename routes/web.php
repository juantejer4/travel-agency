<?php

use App\Http\Controllers\IndexAirlineController;
use App\Http\Controllers\IndexCityController;
use App\Http\Controllers\IndexFlightController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', IndexCityController::class);
Route::get('/airlines', IndexAirlineController::class);
Route::get('/flights', IndexFlightController::class);