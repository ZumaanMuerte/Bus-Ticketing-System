<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    public function user() {
    return $this->belongsTo(User::class);
    }

    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function destination() {
        return $this->belongsTo(Location::class, 'destination_id');
    }

}
