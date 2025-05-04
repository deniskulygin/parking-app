<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->increments('id');
            $table->char('unique_id', 40)->unique()->nullable(false);
            $table->unsignedBigInteger('vehicle_id')->nullable(false);
            $table->unsignedBigInteger('parking_spot_id')->nullable(false);
            $table->unique(['vehicle_id', 'parking_spot_id']);
            $table->boolean('unparked')->default(false);
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('parking_spot_id')->references('id')->on('parking_spots')->onDelete('cascade');
        });
    }
};
