<?php

namespace App\Http\Requests;

use App\Http\DataTransferObjects\CityData;
use Illuminate\Foundation\Http\FormRequest;

class UpsertCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:cities']
        ];
    }

    public function toDto(): CityData
    {
        return new CityData(
            name: $this->input('name')
        );
    }


}
