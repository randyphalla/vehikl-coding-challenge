<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $cars = [
        [
            'id' => 1,
            'name' => 'Si',
            'current_odometer' => 6000,
            'previous_oil_change_odometer' => 4000,
            'previous_oil_change_date' => '2025-06-19',
        ],
        [
            'id' => 2,
            'name' => 'Hatchback',
            'current_odometer' => 4000,
            'previous_oil_change_odometer' => 3500,
            'previous_oil_change_date' => '2025-08-19',
        ],
        [
            'id' => 3,
            'name' => 'Accord Sedan',
            'current_odometer' => 10000,
            'previous_oil_change_odometer' => 6000,
            'previous_oil_change_date' => '2024-01-19',
        ],
        [
            'id' => 4,
            'name' => 'HR-V',
            'current_odometer' => 34000,
            'previous_oil_change_odometer' => 30000,
            'previous_oil_change_date' => '2023-12-19',
        ],
    ];

    public function run(): void
    {
        foreach ($this->cars as $car) {
            DB::table('cars')->insert($car);
        }
    }
}
