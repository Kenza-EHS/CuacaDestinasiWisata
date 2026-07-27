<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('air_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->integer('aqi');             // Air Quality Index
            $table->decimal('pm25', 6, 2);      // Particulate Matter 2.5
            $table->string('status');           // Baik, Sedang, Tidak Sehat
            $table->timestamp('recorded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('air_qualities');
    }
};