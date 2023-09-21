<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirlineRequest;
use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AirlineController extends Controller
{
    public function index(): View
    {
        return view('airlines.show', [
            'links' => Airline::paginate()->links(),
            'cities' => City::all()
        ]);
    }

    public function store(AirlineRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $airline = Airline::create([
            'name' => $attributes['name'],
            'description' => $attributes['description']
        ]);

        if (isset($attributes['cities'])) {
            $cities = City::whereIn('name', $attributes['cities'])->get();
            $airline->cities()->attach($cities);
        }

        return response()->json($airline);
    }

    public function getAirlines(Request $request): JsonResponse
    {
        $response = [];
        $airlines = Airline::with(['cities'])->withCount('incomingFlights')->paginate(intval($request->get('per_page', 15)));
        
        $response['data'] = $airlines;
        return response()->json($response);
    }


    public function update(AirlineRequest $request, Airline $airline): JsonResponse
    {
        $attributes = $request->validated();

        $airline->update([
            'name' => $attributes['name'],
            'description' => $attributes['description']
        ]);

        $cities = [];
        if (isset($attributes['cities'])) {
            $cities = City::whereIn('name', $attributes['cities'])->get();
        }
        $airline->cities()->sync($cities);

        return response()->json(['success' => 'City updated']);
    }

    public function destroy(Airline $airline): JsonResponse
    {
        $airline->delete();
        return response()->json(['success' => 'Airline deleted']);
    }
}