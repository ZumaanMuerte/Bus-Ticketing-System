<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = ['DRIVER_ID', 'NAME', 'SURNAME', 'AGE','LICENSE_NO', 'CONTACT_NO'];
    protected $primaryKey = 'DRIVER_ID';
}
