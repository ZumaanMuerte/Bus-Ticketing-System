<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $fillable = [
        'bus_id',
        'bus_number',       // new
        'bus_type',
        'capacity',
        'current_location', // from destination
    ];

}
