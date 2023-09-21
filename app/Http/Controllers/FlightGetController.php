<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightGetController
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = Flight::with('origin', 'destination', 'airline');

        $sort = $request->query('sort');
        $sortOrder = $request->query('sortOrder');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query->when($sort && in_array($sortOrder, ['asc', 'desc']), function ($query) use ($sort, $sortOrder) {
            return $query->orderBy($sort, $sortOrder);
        });

        $query->when($startDate, function ($query) use ($startDate) {
            return $query->where('departure_time', '>=', $startDate);
        });

        $query->when($endDate, function ($query) use ($endDate) {
            return $query->where('departure_time', '<=', $endDate);
        });

        $flights = $query->paginate();
        $response['data'] = $flights;
        $response['links'] = strval($flights->links());

        return response()->json($response);
    }
}
