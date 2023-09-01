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
        $flights = Flight::with('origin','destination','airline')->paginate();
        $response['data'] = $flights;
        return response()->json($response);
    }

    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();
        return response()->json(['success' => 'Flight deleted']);
    }

}
