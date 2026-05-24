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
        Schema::table('diesels', function (Blueprint $table) {
            $table->string('admin_username')->nullable();
            $table->string('admin_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diesels', function (Blueprint $table) {
            $table->dropColumn(['admin_username', 'admin_password']);
        });
    }
};
