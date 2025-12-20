<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        // 'car_id',
        'current_odometer',
        'previous_oil_change_odometer',
        'previous_oil_change_date',
    ];

    // public function car()
    // {
    //     return $this->belongsTo(Car::class, 'car_id');
    // }
}
