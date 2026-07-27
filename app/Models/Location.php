<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'province',
        'description',
        'image',
    ];

    /**
     * Relasi ke seluruh riwayat data cuaca.
     */
    public function weatherLogs(): HasMany
    {
        return $table = $this->hasMany(WeatherData::class);
    }

    /**
     * Relasi ke data cuaca terbaru (Terbaru berdasarkan recorded_at).
     */
    public function latestWeather(): HasOne
    {
        return $this->hasOne(WeatherData::class)->latestOfMany('recorded_at');
    }

    /**
     * Relasi ke seluruh riwayat kualitas udara.
     */
    public function airQualityLogs(): HasMany
    {
        return $this->hasMany(AirQuality::class);
    }

    /**
     * Relasi ke data kualitas udara terbaru.
     */
    public function latestAirQuality(): HasOne
    {
        return $this->hasOne(AirQuality::class)->latestOfMany('recorded_at');
    }
}