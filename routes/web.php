<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\IndexCityController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;


Route::get('/cities', IndexCityController::class);

Route::get('/airlines', [AirlineController::class, 'index']);

Route::get('/flights', [FlightController::class, 'index']);