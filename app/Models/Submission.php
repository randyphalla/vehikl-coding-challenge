<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['car_id'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
