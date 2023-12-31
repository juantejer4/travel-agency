<?php

namespace App\Http\Controllers\Flight;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;

class DeleteFlightController
{
    public function __invoke(Flight $flight): JsonResponse
    {
        $flight->delete();
        return responder()->success(['success' => 'Flight deleted'])->respond();
    }
}
