<?php

namespace App\Actions\Flight;

use App\Http\Requests\GetFlightRequest;
use App\Models\Flight;
use Illuminate\Pagination\LengthAwarePaginator;

class GetFlightsAction
{
    public function execute(GetFlightRequest $request) : LengthAwarePaginator
    {
        $flightData = $request->toDto();

        $query = Flight::with('origin', 'destination', 'airline');

        if (isset($flightData->sort) && isset($flightData->sortOrder)) {
            $query->orderBy($flightData->sort, $flightData->sortOrder);
        }

        if (isset($flightData->startDate)) {
            $query->where('departure_time', '>=', $flightData->startDate);
        }

        if (isset($flightData->endDate)) {
            $query->where('departure_time', '<=', $flightData->endDate);
        }

        return $query->paginate();
    }
}
