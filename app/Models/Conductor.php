<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $fillable = ['conductor_id','name', 'surname','age', 'license_no','contact_no'];
    protected $primaryKey='conductor_id';
}
