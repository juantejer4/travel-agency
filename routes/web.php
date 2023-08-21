<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;


Route::get('/cities', [CityController::class, 'index']);

Route::get('/airlines', [AirlineController::class, 'index']);