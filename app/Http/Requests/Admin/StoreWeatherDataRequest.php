<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeatherDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'location_id' => ['required', 'exists:locations,id'],
            'temperature' => ['required', 'numeric', 'between:-50,60'],
            'condition' => ['required', 'string', 'max:100'],
            'humidity' => ['required', 'integer', 'between:0,100'],
            'wind_speed' => ['required', 'numeric', 'min:0'],
            'recorded_at' => ['required', 'date'],
        ];
    }
}