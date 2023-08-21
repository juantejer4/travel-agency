<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'cities'], function () {
    Route::post('/', [CityController::class, 'store'])->name('cities.store');
    Route::delete('/{city}', [CityController::class, 'destroy'])->name('cities.destroy');
    Route::put('/{city}', [CityController::class, 'update'])->name('cities.update');
    Route::get('/', [CityController::class, 'getCities']);
});

Route::group(['prefix' => 'airlines'], function () {
    Route::get('/', [AirlineController::class, 'getAirlines']);
});