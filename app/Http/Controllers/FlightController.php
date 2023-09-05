<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FlightController extends Controller
{
    public function index(): View
    {
        return view('flights.show');
    }

    public function getFlights(): JsonResponse
    {
        $flights = Flight::with('origin','destination','airline')->paginate();
        $response['data'] = $flights;
        return response()->json($response);
    }

    public function store(Request $request): JsonResponse
    {
        $attributes = $request->validate([
            'airline_id' => ['required'],
            'origin_city_id' => ['required'],
            'destination_city_id' => ['required'],
            'departure_time' => ['required'],
            'arrival_time' => ['required']
        ]);
        $flights = Flight::create($attributes);

        return response()->json($flights);
    }

    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();
        return response()->json(['success' => 'Flight deleted']);
    }

}
