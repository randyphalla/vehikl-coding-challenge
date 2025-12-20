<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// https://laravel.com/docs/12.x/controllers
class CarController extends Controller
{
    public function index()
    {
        $cars = DB::table('cars')->get();
        return view('home', ['cars' => $cars]);
    }

    public function show($id)
    {
        $car = DB::table('cars')->find($id);

        if (!$car) return redirect('/');

        return view('form', ['car' => $car]);
    }
}
