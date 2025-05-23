<?php

namespace App\Helpers;

use App\Models\Location;
use App\Models\TicketPrice;

class FareCalculator
{
    public static function compute($from, $to, $busType, $busStop, $passengerType)
    {
        $origin = Location::where('location', $from)->first();
        $destination = Location::where('location', $to)->first();

        if (!$origin || !$destination) return null;

        $distance = abs($destination->distance_from_cdo - $origin->distance_from_cdo);
        $pricing = TicketPrice::where('bus_type', $busType)
                              ->where('bus_stop', $busStop)
                              ->first();

        if (!$pricing) return null;

        $baseFare = $pricing->base_fare;
        $additionalKm = max(0, $distance - 5);
        $total = $baseFare + ($additionalKm * 1.8);

        if (in_array($passengerType, ['student', 'pwd', 'senior'])) {
            $total *= 0.8;
        }

        return round($total);
    }
}
