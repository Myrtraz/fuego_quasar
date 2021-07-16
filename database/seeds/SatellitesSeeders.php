<?php

use Illuminate\Database\Seeder;
use App\Modal\Satellites;
class SatellitesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Satellites::create([
            'name' => 'kenobi',
            'distance' => 100.0,
            'message' => '[" " ,"este", " ", "un", "mensaje"]',
        ]);

        Satellites::create([
            'name' => 'skywalker',
            'distance' => 115.5,
            'message' => '["este", " ", "un", " ", "mensaje"]',
        ]);

        Satellites::create([
            'name' => 'sato',
            'distance' => 142.7,
            'message' => '[" ", " ", "es", " ", "mensaje"]',
        ]);
    }
}
