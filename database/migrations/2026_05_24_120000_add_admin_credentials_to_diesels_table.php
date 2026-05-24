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
        // Only add the columns if they don't already exist (prevents failures on re-run)
        if (!Schema::hasColumn('diesels', 'admin_username') || !Schema::hasColumn('diesels', 'admin_password')) {
            Schema::table('diesels', function (Blueprint $table) {
                if (!Schema::hasColumn('diesels', 'admin_username')) {
                    $table->string('admin_username')->nullable()->after('deisel_total_liters');
                }
                if (!Schema::hasColumn('diesels', 'admin_password')) {
                    $table->string('admin_password')->nullable()->after('admin_username');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if they exist
        if (Schema::hasColumn('diesels', 'admin_username') || Schema::hasColumn('diesels', 'admin_password')) {
            Schema::table('diesels', function (Blueprint $table) {
                if (Schema::hasColumn('diesels', 'admin_username')) {
                    $table->dropColumn('admin_username');
                }
                if (Schema::hasColumn('diesels', 'admin_password')) {
                    $table->dropColumn('admin_password');
                }
            });
        }
    }
};
