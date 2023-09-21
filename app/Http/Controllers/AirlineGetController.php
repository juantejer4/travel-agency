<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AirlineGetController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $response = [];
        $airlines = Airline::with(['cities'])->withCount('incomingFlights')->paginate(intval($request->get('per_page', 15)));
        
        $response['data'] = $airlines;
        return response()->json($response);
    }
}
