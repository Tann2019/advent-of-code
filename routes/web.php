<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdventOfCodeController;

Route::get('/', [AdventOfCodeController::class, 'index']);
Route::get('/day1', [AdventOfCodeController::class, 'day1']);
Route::get('/day2', [AdventOfCodeController::class, 'day2']);
