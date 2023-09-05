<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'cities', 'controller' => CityController::class], function () {
    Route::post('/', 'store')->name('cities.store');
    Route::delete('/{city}', 'destroy')->name('cities.destroy');
    Route::put('/{city}', 'update')->name('cities.update');
    Route::get('/', 'getCities');
    Route::get('/{city}', 'getCityById');
});

Route::group(['prefix' => 'airlines', 'controller' => AirlineController::class], function () {
    Route::get('/', 'getAirlines');
    Route::post('/', 'store')->name('airlines.store');
    Route::delete('/{airline}', 'destroy')->name('airlines.destroy');
    Route::put('/{airline}', 'update')->name('airlines.update');
    Route::get('/{airline}', 'getAirlineById');
});

Route::group(['prefix' => 'flights', 'controller' => FlightController::class], function () {
    Route::get('/', 'getFlights');
    Route::delete('/{flight}', 'destroy');
    Route::post('/', 'store');
});