<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;


class FlightController extends Controller
{
    public function index() {
        $flights = Flight::all();
        return view('schedule', ['flights' => $flights]);
    }

    public function show($id) {
        $flight = Flight::findOrFail($id);
        return view("flight",["flight"=>$flight]);
    }



    public function store(Request $request){
        //TODO check isRDZ
        $request->validate([
            'plane_id' => "required|min:0",
            'departure'=> "required|date|after:now", //Test that pls
        ]);
        Flight::create($request->all());
        return redirect()->route("flight.index")
            ->with("success","Un vol a été crée");
    }

    public function edit($id){
        //TODO check isRDZ
        $flight = Flight::findOrFail($id);
        return view("editFlight",["flight" => $flight]);
    }

    public function update(Request $request, $id){
        //TODO check isRDZ
        Flight::findOrFail($id)->update($request->all());
        return redirect()->route('flight.index')
        ->with('success','Vol a été mis à jour');
    }

    public function destroy($id){
        //TODO Check is RDZ
        $flight = Flight::findOrFail($id);
        $flight->delete();
        return redirect()->route('flight.index')
                    ->with('success','Vol supprimé');
    }
}
