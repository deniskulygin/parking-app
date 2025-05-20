<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ParkingLotSeeder::class,
            ParkingSpotSeeder::class,
            VehicleSeeder::class,
            ParkingSeeder::class,
        ]);
    }
}
