<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;


Route::get('/cities', [CityController::class, 'index']);
Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
