<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('home');
});

Route::get('/car/{id}', function() {
    return view('form');
});

Route::post('/check', function () {
    return view('welcome');
});

Route::get('/result/{id}', function () {
    return view('result');
});
