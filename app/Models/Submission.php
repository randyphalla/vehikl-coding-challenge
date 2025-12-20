<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'current_odometer',
        'previous_oil_change_odometer',
        'previous_oil_change_date',
    ];
}
