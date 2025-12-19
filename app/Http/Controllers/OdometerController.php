<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OdometerController extends Controller
{
    public function index()
    {
        $cars = [
            [
                'id' => 1,
                'name' => 'Si',
                'current_odometer' => 6000,
                'previous_oil_change_date' => 4000,
                'previous_oil_change_odometer' => '6-19-2025',
            ],
            [
                'id' => 2,
                'name' => 'Hatchback',
                'current_odometer' => 4000,
                'previous_oil_change_date' => 3500,
                'previous_oil_change_odometer' => '8-19-2025',
            ],
            [
                'id' => 3,
                'name' => 'Accord Sedan',
                'current_odometer' => 10000,
                'previous_oil_change_date' => 6000,
                'previous_oil_change_odometer' => '1-19-2024',
            ],
            [
                'id' => 4,
                'name' => 'HR-V',
                'current_odometer' => 34000,
                'previous_oil_change_date' => 30000,
                'previous_oil_change_odometer' => '12-19-2023',
            ],
        ];

        return view('home', ['cars' => $cars]);
    }

    public function create()
    {
        return view('form');
    }

    public function store()
    {
        return view('form');
    }

    public function show($id)
    {
        return view('form');
    }

    public function edit($id)
    {
        return view('form');
    }

    public function update($id)
    {
        return view('form');
    }

    public function delete($id)
    {
        return view('form');
    }
}
