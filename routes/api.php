<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\StoreCityController;
use App\Http\Controllers\DestroyCityController;
use App\Http\Controllers\UpdateCityController;
use App\Http\Controllers\GetCitiesController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cities'], function () {
    Route::post('/', StoreCityController::class);
    Route::delete('/{city}', DestroyCityController::class);
    Route::put('/{city}', UpdateCityController::class);
    Route::get('/', GetCitiesController::class);
});

Route::group(['prefix' => 'airlines', 'controller' => AirlineController::class], function () {
    Route::get('/', 'getAirlines');
    Route::post('/', 'store')->name('airlines.store');
    Route::delete('/{airline}', 'destroy')->name('airlines.destroy');
    Route::put('/{airline}', 'update')->name('airlines.update');
});

Route::group(['prefix' => 'flights', 'controller' => FlightController::class], function () {
    Route::get('/', 'getFlights');
    Route::put('/{flight}', 'update');
    Route::delete('/{flight}', 'destroy');
    Route::post('/', 'store');
});