<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;

// Submissions
// Route::get('/', [SubmissionController::class, 'index'])->name('submission-index');
Route::get('/', [SubmissionController::class, 'create'])->name('submission-create');
Route::post('/check', [SubmissionController::class, 'store'])->name('submission-store');
Route::get('/result/{id?}', [SubmissionController::class, 'show'])->name('submission-show');
// Route::put('/submissions/{id}', [SubmissionController::class, 'update']);
// Route::get('/result/{id}/edit', [SubmissionController::class, 'edit']);
// Route::delete('/submissions/{id}', [SubmissionController::class, 'destory']);