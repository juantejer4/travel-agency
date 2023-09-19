<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FlightController extends Controller
{
    public function index(): View
    {
        return view('flights.show', [
            'links' => Flight::paginate()->links()
        ]);
    }

    public function getFlights(Request $request): JsonResponse
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


    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'airline_id' => ['required', 'exists:airlines,id'],
            'origin_city_id' => ['required', 'exists:cities,id'],
            'destination_city_id' => ['required', 'exists:cities,id', 'different:origin_city_id'],
            'departure_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'arrival_time' => ['required', 'date_format:Y-m-d\TH:i', 'after:departure_time']
        ]);

        $flights = Flight::create($validatedData);

        return response()->json($flights);
    }


    public function update(Request $request, Flight $flight): JsonResponse
    {
        $validatedData = $request->validate([
            'airline_id' => ['required', 'exists:airlines,id'],
            'origin_city_id' => ['required', 'exists:cities,id'],
            'destination_city_id' => ['required', 'exists:cities,id', 'different:origin_city_id'],
            'departure_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'arrival_time' => ['required', 'date_format:Y-m-d\TH:i', 'after:departure_time']
        ]);

        $flight->update($validatedData);

        return response()->json($flight);
    }


    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();
        return response()->json(['success' => 'Flight deleted']);
    }
}
