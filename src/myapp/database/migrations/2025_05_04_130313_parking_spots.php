<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->increments('id');
            $table->char('unique_id', 40)->unique()->nullable(false);
            $table->unsignedBigInteger('parking_lot_id');
            $table->boolean('is_occupied')->default(false);
            $table->timestamps();
            $table->foreign('parking_lot_id')->references('id')->on('parking_lots')->onDelete('cascade');
        });
    }
};
