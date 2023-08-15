<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){

        return view('cities.show', [
            'cities' => City::orderBy('id', 'asc')->get()
        ]);
    }

    public function store(Request $request){

        $attributes = $request->validate([
            'name' => 'required|unique:cities'
        ]);

        $city = City::create($attributes);
        return Response()->json($city);
    }

    public function getCities(){
        $cities = City::orderby('id','asc')->select('*')->get(); 
        $response['data'] = $cities;
        return response()->json($response);
      }
}
