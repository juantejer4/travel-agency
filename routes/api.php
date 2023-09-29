<?php

use App\Http\Controllers\Airline\DeleteAirlineController;
use App\Http\Controllers\Airline\GetAirlineController;
use App\Http\Controllers\Airline\StoreAirlineController;
use App\Http\Controllers\Airline\UpdateAirlineController;

use App\Http\Controllers\City\DeleteCityController;
use App\Http\Controllers\City\GetCitiesController;
use App\Http\Controllers\City\StoreCityController;
use App\Http\Controllers\City\UpdateCityController;

use App\Http\Controllers\Flight\DeleteFlightController;
use App\Http\Controllers\Flight\GetFlightController;
use App\Http\Controllers\Flight\StoreFlightController;
use App\Http\Controllers\Flight\UpdateFlightController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cities'], function () {
    Route::post('/', StoreCityController::class);
    Route::delete('/{city}', DeleteCityController::class);
    Route::put('/{city}', UpdateCityController::class);
    Route::get('/', GetCitiesController::class);
});

Route::group(['prefix' => 'airlines'], function () {
    Route::post('/', StoreAirlineController::class);
    Route::delete('/{airline}', DeleteAirlineController::class);
    Route::put('/{airline}', UpdateAirlineController::class);
    Route::get('/', GetAirlineController::class);
});

Route::group(['prefix' => 'flights'], function () {
    Route::get('/', GetFlightController::class);
    Route::post('/', StoreFlightController::class);
    Route::put('/{flight}', UpdateFlightController::class);
    Route::delete('/{flight}', DeleteFlightController::class);
});
