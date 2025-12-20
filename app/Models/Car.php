<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'current_odometer',
        'previous_oil_change_odometer',
        'previous_oil_change_date',
    ];

    public function submission()
    {

    }
}
