<?php

namespace App\Http\Requests;

use App\Http\DataTransferObjects\AirlineData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAirlineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('airlines')->ignore($this->airline->id)],
            'description' => ['nullable'],
            'cities' => ['array']
        ];
    }
    public function toDto(): AirlineData
    {
        return new AirlineData(
            name: $this->input('name'),
            description: $this->input('description'),
            cities: $this->input('cities')
        );
    }
}
