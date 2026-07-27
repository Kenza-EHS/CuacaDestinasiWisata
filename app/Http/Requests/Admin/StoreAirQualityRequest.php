<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirQualityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'location_id' => ['required', 'exists:locations,id'],
            'aqi' => ['required', 'integer', 'min:0'],
            'pm25' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:Baik,Sedang,Tidak Sehat,Sangat Tidak Sehat,Berbahaya'],
            'recorded_at' => ['required', 'date'],
        ];
    }
}