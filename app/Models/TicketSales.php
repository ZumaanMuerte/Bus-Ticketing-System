<?php

// app/Models/TicketSale.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketSales extends Model
{
    protected $table = 'ticket_prices';
    protected $fillable = ['date', 'bus_id', 'driver_id', 'konductor_id', 'total_passengers', 'sales'];

    public function bus()
    {
        return $this->belongsTo(\App\Models\Bus::class);
    }

    public function driver()
    {
        return $this->belongsTo(\App\Models\InBusEmployee::class, 'driver_id');
    }

    public function konductor()
    {
        return $this->belongsTo(\App\Models\InBusEmployee::class, 'konductor_id');
    }
}

