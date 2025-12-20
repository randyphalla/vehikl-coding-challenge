<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ResultsController;

// Cars
Route::get('/', [CarController::class, 'index'])->name('home');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('car-show');
// Route::post('/cars', [CarController::class, 'store']);
// Route::get('/cars/{id}/edit', [CarController::class, 'edit']);
// Route::put('/cars/{id}', [CarController::class, 'update']);
// Route::delete('/cars/{id}', [CarController::class, 'destory']);

// Submissions
Route::post('/check', [ResultsController::class, 'store'])->name('submission-check');
Route::get('/result/{id}', [ResultsController::class, 'show'])->name('submission-show');
// Route::get('/submissions', [ResultsController::class, 'index']);
// Route::put('/submissions/{id}', [ResultsController::class, 'update']);
// Route::get('/result/{id}/edit', [ResultsController::class, 'edit']);
// Route::delete('/submissions/{id}', [ResultsController::class, 'destory']);