<?php

use App\Http\Controllers\CityStoreController;
use App\Http\Controllers\CityDestroyController;
use App\Http\Controllers\CityUpdateController;
use App\Http\Controllers\CityGetController;

use App\Http\Controllers\AirlineStoreController;
use App\Http\Controllers\AirlineDestroyController;
use App\Http\Controllers\AirlineUpdateController;
use App\Http\Controllers\AirlineGetController;

use App\Http\Controllers\FlightGetController;
use App\Http\Controllers\FlightStoreController;
use App\Http\Controllers\FlightUpdateController;
use App\Http\Controllers\FlightDestroyController;

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

Route::group(['prefix' => 'flights'], function () {
    Route::get('/', FlightGetController::class);
    Route::post('/', FlightStoreController::class);
    Route::put('/{flight}', FlightUpdateController::class);
    Route::delete('/{flight}', FlightDestroyController::class);
});