<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SubmissionController;

// Cars
Route::get('/', [CarController::class, 'index'])->name('home');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('car-show');
// Route::post('/cars', [CarController::class, 'store']);
// Route::get('/cars/{id}/edit', [CarController::class, 'edit']);
// Route::put('/cars/{id}', [CarController::class, 'update']);
// Route::delete('/cars/{id}', [CarController::class, 'destory']);

// Submissions
Route::post('/check', [SubmissionController::class, 'store'])->name('submission-store');
Route::get('/result/{id}', [SubmissionController::class, 'show'])->name('submission-show');
// Route::get('/submissions', [SubmissionController::class, 'index']);
// Route::put('/submissions/{id}', [SubmissionController::class, 'update']);
// Route::get('/result/{id}/edit', [SubmissionController::class, 'edit']);
// Route::delete('/submissions/{id}', [SubmissionController::class, 'destory']);