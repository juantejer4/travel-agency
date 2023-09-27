<?php

namespace App\Http\Requests;

use App\DataTransferObjects\AirlineData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAirlineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('airlines')],
            'description' => ['nullable'],
            'cities' => ['array']
        ];
    }

    public function toDto(): AirlineData
    {
        return new AirlineData(name: $this->input('name'),
                                description: $this->input('description'),
                                cities:$this->input('cities'));
    }
}
