<?php

namespace App\Http\Requests;

use App\Http\DataTransferObjects\SortFlightData;
use Illuminate\Foundation\Http\FormRequest;

class GetFlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sort' => 'sometimes|string',
            'sortOrder' => 'sometimes|in:asc,desc',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date'
        ];
    }

    public function toDto(): SortFlightData
    {
        return new SortFlightData(
            $this->input('sort'),
            $this->input('sortOrder'),
            $this->input('start_date'),
            $this->input('end_date')
        );
    }

}
