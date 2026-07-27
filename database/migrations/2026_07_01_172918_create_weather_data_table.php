<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->decimal('temperature', 5, 2); // Contoh: 29.50
            $table->string('condition');          // Contoh: Cerah, Hujan Ringan
            $table->integer('humidity');           // Kelembaban (%)
            $table->decimal('wind_speed', 5, 2);  // Kecepatan angin (km/h)
            $table->timestamp('recorded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};