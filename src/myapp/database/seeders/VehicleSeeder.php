<?php

namespace Database\Seeders;

use App\Dict\VehicleTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vehicles')->insert([
            [
                'unique_id' => Str::uuid(),
                'type' => VehicleTypes::CAR->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_id' => Str::uuid(),
                'type' => VehicleTypes::MOTORCYCLE->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unique_id' => Str::uuid(),
                'type' => VehicleTypes::VAN->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
