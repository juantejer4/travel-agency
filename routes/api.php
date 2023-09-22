<?php

use App\Http\Controllers\StoreCityController;
use App\Http\Controllers\DeleteCityController;
use App\Http\Controllers\UpdateCityController;
use App\Http\Controllers\GetCityController;

use App\Http\Controllers\StoreAirlineController;
use App\Http\Controllers\DeleteAirlineController;
use App\Http\Controllers\UpdateAirlineController;
use App\Http\Controllers\GetAirlineController;

use App\Http\Controllers\GetFlightController;
use App\Http\Controllers\StoreFlightController;
use App\Http\Controllers\UpdateFlightController;
use App\Http\Controllers\DeleteFlightController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cities'], function () {
    Route::post('/', StoreCityController::class);
    Route::delete('/{city}', DeleteCityController::class);
    Route::put('/{city}', UpdateCityController::class);
    Route::get('/', GetCityController::class);
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