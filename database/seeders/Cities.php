<?php

namespace Database\Seeders;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            [
                'name' => 'Strasbourg',
                'zipcode' => '67000',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'Strasbourg',
                'zipcode' => '67100',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'Eckbolsheim',
                'zipcode' => '67201',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'Illkirch-Graffenstaden',
                'zipcode' => '67400',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'Hoenheim',
                'zipcode' => '67800',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'Bischheim',
                'zipcode' => '67800',
                'created_at' => Carbon::now()->toDateTimeString()
            ]
        ]);
    }
}
