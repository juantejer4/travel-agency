<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AirlineController extends Controller
{
    public function index() : View{
        return view('airlines.show',[
            'links' => Airline::paginate()->links()
        ]);
    }
}
