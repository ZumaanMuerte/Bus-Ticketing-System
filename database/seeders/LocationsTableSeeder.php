<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            // Main Cities
            ['location' => 'Cagayan de Oro City', 'distance_from_cdo' => 0, 'is_stopover' => false],
            ['location' => 'Gingoog City', 'distance_from_cdo' => 122, 'is_stopover' => false],
            ['location' => 'Butuan', 'distance_from_cdo' => 186, 'is_stopover' => false],
            ['location' => 'Surigao City', 'distance_from_cdo' => 330, 'is_stopover' => false],
            ['location' => 'Surigao del Sur', 'distance_from_cdo' => 410, 'is_stopover' => false],
            ['location' => 'Malaybalay, Bukidnon', 'distance_from_cdo' => 91, 'is_stopover' => false],
            ['location' => 'Davao City', 'distance_from_cdo' => 320, 'is_stopover' => false],

            // Provincial Stops (stopovers)
            ['location' => 'Tagoloan', 'distance_from_cdo' => 19.0, 'is_stopover' => true],
            ['location' => 'Villanueva', 'distance_from_cdo' => 27.4, 'is_stopover' => true],
            ['location' => 'Claveria', 'distance_from_cdo' => 55.0, 'is_stopover' => true],
            ['location' => 'Balingasag', 'distance_from_cdo' => 62.7, 'is_stopover' => true],
            ['location' => 'Lagonglong', 'distance_from_cdo' => 70.4, 'is_stopover' => true],
            ['location' => 'Salay', 'distance_from_cdo' => 87.0, 'is_stopover' => true],
            ['location' => 'Talisayan', 'distance_from_cdo' => 98.5, 'is_stopover' => true],
            ['location' => 'Medina', 'distance_from_cdo' => 110.0, 'is_stopover' => true],
            ['location' => 'Magsaysay', 'distance_from_cdo' => 115.0, 'is_stopover' => true],
            ['location' => 'Nasipit', 'distance_from_cdo' => 170.0, 'is_stopover' => true],
            ['location' => 'Cabadbaran', 'distance_from_cdo' => 196.0, 'is_stopover' => true],
            ['location' => 'Kitcharao', 'distance_from_cdo' => 220.0, 'is_stopover' => true],
            ['location' => 'Tubod', 'distance_from_cdo' => 280.0, 'is_stopover' => true],
            ['location' => 'Tagum City', 'distance_from_cdo' => 300.0, 'is_stopover' => true],
        ];

        DB::table('locations')->insert($locations);
    }
}

