<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OdometerController;

Route::get('/', [OdometerController::class, 'index']);
Route::post('/cars', [OdometerController::class, 'store']);
Route::get('/cars/{id}/edit', [OdometerController::class, 'edit']);
Route::put('/cars/{id}', [OdometerController::class, 'update']);
Route::delete('/cars/{id}', [OdometerController::class, 'destory']);
