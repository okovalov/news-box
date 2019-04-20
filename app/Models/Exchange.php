<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_currency_code',
        'to_currency_code',
        'rate',
        'refreshed_at'
    ];

}
