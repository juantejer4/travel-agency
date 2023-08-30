<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class FlightController extends Controller
{
    public function index(): View
    {
        return view('flights.show');
    }

    public function getFlights(): JsonResponse
    {
        $flights = Flight::paginate();
        $response['data'] = $flights;
        return response()->json($response);
    }

}
