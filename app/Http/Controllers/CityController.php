<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){

        return view('cities.show',[
            'links' => City::orderby('id','asc')->select('*')->paginate()->links()
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
        $cities = City::orderby('id','asc')->select('*')->paginate();
        $response['data'] = $cities;
        return response()->json($response);
    }

    public function update(Request $request, $id){
        $attributes = $request->validate([
            'name' => 'required|unique:cities'
        ]);
        
        City::find($id)->update([
            'name' => $request->name
        ]);
    }

    public function destroy($id){
        City::find($id)->delete($id);
    }
}
