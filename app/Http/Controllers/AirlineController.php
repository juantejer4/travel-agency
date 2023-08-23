<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AirlineController extends Controller
{
    public function index() : View{
        return view('airlines.show',[
            'links' => Airline::paginate()->links(),
            'cities' => City::all()
        ]);
    }

    public function store(Request $request) : JsonResponse{
        $attributes = $request->validate([
            'name' => ['required', 'unique:airlines'],
            'description' => ['nullable'],
            'cities' => ['nullable']
        ]);
        $airline = Airline::create([
            'name' => $attributes['name'],
            'description' => $attributes['description']
        ]);

        if (isset($attributes['cities'])) {
            $cities = City::whereIn('name',$attributes['cities'])->get();
            $airline->cities()->attach($cities);
        }        
        
        return response()->json($airline);
    }

    public function getAirlines() : JsonResponse{
        $airlines = Airline::paginate();
        $response['data'] = $airlines;
        return response()->json($response);
    }

    public function destroy(Airline $airline) : JsonResponse {
        $airline->delete();
        return response()->json(['success' => 'Airline deleted']);
    }
}
