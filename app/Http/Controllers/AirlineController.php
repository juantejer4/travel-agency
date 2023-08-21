<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AirlineController extends Controller
{
    public function index() : View{
        return view('airlines.show',[
            'links' => Airline::paginate()->links()
        ]);
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
