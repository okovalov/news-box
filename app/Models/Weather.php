<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = [
        'weather_id',
        'location',
        'type',
        'description',
        'wind',
        'clouds',
    ];
}
