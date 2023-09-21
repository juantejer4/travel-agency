<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityStoreController;
use App\Http\Controllers\CityDestroyController;
use App\Http\Controllers\CityUpdateController;
use App\Http\Controllers\CityGetController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cities'], function () {
    Route::post('/', CityStoreController::class);
    Route::delete('/{city}', CityDestroyController::class);
    Route::put('/{city}', CityUpdateController::class);
    Route::get('/', CityGetController::class);
});

Route::group(['prefix' => 'airlines'], function () {
    Route::post('/', AirlineStoreController::class);
    Route::delete('/{airline}', AirlineDestroyController::class);
    Route::put('/{airline}', AirlineUpdateController::class);
    Route::get('/', AirlineGetController::class);
});

Route::group(['prefix' => 'flights', 'controller' => FlightController::class], function () {
    Route::get('/', 'getFlights');
    Route::put('/{flight}', 'update');
    Route::delete('/{flight}', 'destroy');
    Route::post('/', 'store');
});