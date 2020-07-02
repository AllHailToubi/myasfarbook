<?php

namespace Modules\Hotel\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class HotelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Model::unguard();
        Cache::flush();

        $this->call(SeedCreateHotelTableSeeder::class);
        //$this->call(FillAmentiesTableSeeder::class);
    }
}
