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
        Schema::table('locations', function (Blueprint $table) {
            // Menggunakan fungsi up() yang valid agar dieksekusi oleh Laravel Engine
            $table->text('image_url')->nullable()->after('region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            // Fungsi penanganan pembatalan (rollback) yang valid
            $table->dropColumn('image_url');
        });
    }
};