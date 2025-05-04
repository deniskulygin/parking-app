<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->increments('id');
            $table->char('unique_id', 40)->unique()->nullable(false);
            $table->string('name');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }
};
