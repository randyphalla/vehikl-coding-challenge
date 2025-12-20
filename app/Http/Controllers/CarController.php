<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// https://laravel.com/docs/12.x/controllers
class CarController extends Controller
{
    protected $cars = [
        [
            'id' => 1,
            'name' => 'Si',
            'current_odometer' => 6000,
            'previous_oil_change_odometer' => 4000,
            'previous_oil_change_date' => '6-19-2025',
        ],
        [
            'id' => 2,
            'name' => 'Hatchback',
            'current_odometer' => 4000,
            'previous_oil_change_odometer' => 3500,
            'previous_oil_change_date' => '8-19-2025',
        ],
        [
            'id' => 3,
            'name' => 'Accord Sedan',
            'current_odometer' => 10000,
            'previous_oil_change_odometer' => 6000,
            'previous_oil_change_date' => '1-19-2024',
        ],
        [
            'id' => 4,
            'name' => 'HR-V',
            'current_odometer' => 34000,
            'previous_oil_change_odometer' => 30000,
            'previous_oil_change_date' => '12-19-2023',
        ],
    ];

    public function index()
    {
        return view('home', ['cars' => $this->cars]);
    }

    public function show($id)
    {
        $car = collect($this->cars)->firstWhere('id', $id);

        // if ($car) {
        //     echo "Car doesnt exist!";
        // }

        return view('form', ['car' => $car]);
    }

    // public function create() {}

    // public function store() {}

    // public function edit($id) {}

    // public function update($id) {}

    // public function delete($id) {}
}
