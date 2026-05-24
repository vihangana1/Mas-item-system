<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw statements to avoid requiring doctrine/dbal
        DB::statement('ALTER TABLE `diesels` MODIFY `main_storage_tank_level` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `main_storage_tank_liters` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `boiler_day_tank_level` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `boiler_day_tank_liters` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `generator_1_liters` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `generator_2_liters` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `generator_3_liters` INT NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `deisel_total_liters` INT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE `diesels` MODIFY `main_storage_tank_level` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `main_storage_tank_liters` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `boiler_day_tank_level` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `boiler_day_tank_liters` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `generator_1_liters` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `generator_2_liters` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `generator_3_liters` DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE `diesels` MODIFY `deisel_total_liters` DECIMAL(10,2) NULL');
    }
};
