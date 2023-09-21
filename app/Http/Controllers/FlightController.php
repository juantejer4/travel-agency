<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertFlightRequest;
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


    public function store(UpsertFlightRequest $request): JsonResponse
    {

        $flights = Flight::create($request->validated());
        return response()->json($flights);
    }

    public function update(UpsertFlightRequest $request, Flight $flight): JsonResponse
    {
        $flight->update($request->validated());
        return response()->json($flight);
    }

    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();
        return response()->json(['success' => 'Flight deleted']);
    }
}
