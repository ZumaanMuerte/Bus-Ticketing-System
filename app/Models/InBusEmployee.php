<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InBusEmployee extends Model
{
    protected $fillable = ['license_no', 'name', 'age', 'contact_no', 'in_bus_role'];
}

