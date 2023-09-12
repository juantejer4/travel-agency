<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FlightController extends Controller
{
    public function index(): View
    {
        return view('flights.show', [
            'links' => Flight::paginate()->links()
        ]);
    }

    public function getFlights(): JsonResponse
    {
        $flights = Flight::with('origin','destination','airline')->paginate();
        $response['data'] = $flights;
        return response()->json($response);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'airline_id' => ['required', 'exists:airlines,id'],
            'origin_city_id' => ['required', 'exists:cities,id'],
            'destination_city_id' => [
                'required',
                'exists:cities,id',
                Rule::notIn([$request->origin_city_id])
            ],
            'departure_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'arrival_time' => ['required', 'date_format:Y-m-d\TH:i', 'after:departure_time']
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $flights = Flight::create($request->all());
    
        return response()->json($flights);
    }


    public function update(Request $request, Flight $flight): JsonResponse
    {
        $attributes = $request->validate([
            'airline_id' => ['required'],
            'origin_city_id' => ['required'],
            'destination_city_id' => ['required'],
            'departure_time' => ['required'],
            'arrival_time' => ['required']
        ]);

        $flight->update($attributes);

        return response()->json($flight);
    }

    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();
        return response()->json(['success' => 'Flight deleted']);
    }

}
