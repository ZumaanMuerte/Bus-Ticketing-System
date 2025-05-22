<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketPrice;

class TicketPriceSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'bus_type' => 'non-air-condition',
                'bus_stop' => 'provincial',
                'base_fare' => 13.00,
            ],
            [
                'bus_type' => 'air-condition',
                'bus_stop' => 'provincial',
                'base_fare' => 15.00,
            ],
            [
                'bus_type' => 'air-condition',
                'bus_stop' => 'non-stop',
                'base_fare' => 18.00,
            ],
        ];

        foreach ($data as $price) {
            TicketPrice::create($price);
        }
    }
}
