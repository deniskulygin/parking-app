<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParkingSpotSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('parking_spots')->insert([
            [
                'unique_id' => Str::uuid(),
                'parking_lot_id' => 1,
                'is_occupied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_id' => Str::uuid(),
                'parking_lot_id' => 1,
                'is_occupied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_id' => Str::uuid(),
                'parking_lot_id' => 2,
                'is_occupied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
