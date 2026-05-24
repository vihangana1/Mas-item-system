<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diesels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('diesel_fill_date')->nullable();
            $table->decimal('main_storage_tank_level', 10, 2)->nullable();
            $table->decimal('main_storage_tank_liters', 10, 2)->nullable();

            $table->decimal('boiler_day_tank_level', 10, 2)->nullable();
            $table->decimal('boiler_day_tank_liters', 10, 2)->nullable();
            $table->decimal('generator_1_liters', 10, 2)->nullable();
            $table->decimal('generator_2_liters', 10, 2)->nullable();
            $table->decimal('generator_3_liters', 10, 2)->nullable();
            $table->decimal('deisel_total_liters', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diesels');
    }
};
