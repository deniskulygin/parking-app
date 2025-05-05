<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParkingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('parkings')->insert([
            [
                'unique_id' => Str::uuid(),
                'vehicle_id' => 1,
                'parking_spot_id' => 1,
                'parked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_id' => Str::uuid(),
                'vehicle_id' => 2,
                'parking_spot_id' => 3,
                'parked' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
