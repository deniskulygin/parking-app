<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParkingLotSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('parking_lots')->insert([
            [
                'unique_id' => Str::uuid(),
                'name' => 'Downtown Lot',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_id' => Str::uuid(),
                'name' => 'Airport Lot',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
