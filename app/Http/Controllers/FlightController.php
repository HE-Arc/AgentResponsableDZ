<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Plane;

use function PHPUnit\Framework\isNull;

class FlightController extends Controller
{
    public function index() {
        $flights = Flight::orderBy('departure', 'asc')->get();
        return view('schedule', ['flights' => $flights]);
    }

    public function create(){
        //TODO Check is rdz
        $planes = Plane::all(); //To give a selection to the user
        return view("newFlightForm", ['planes' => $planes]);
    }

    public function store(Request $request){
        //TODO check isRDZ
        $request->validate([
            'plane' => "required|min:1",
            'departure'=> "required|date_format:H:i", //Test that pls
        ]);
        //Find which plane was selected. Plane is [plane name] (HB-XXX)
        //It will always be HB-[a-bA-B1-9]{3}
        $p = $request->input("plane");
        $reg = strtoupper(substr($p,strlen($p) - 7,6));

        //Check if it is a vaid reg
        if(preg_match("/HB-[a-zA-Z1-9]{3}/i",$reg) == 1){
            $plane = Plane::where("registration","=",$reg)->first();
            if($plane != null){ //Check if the plane exists
                //Add flight to database
                //dd($plane);
                $time = $request->input("departure");
                $flight = Flight::create([
                    "plane_id" => $plane->id,
                    "departure" => date("Y-m-d") . " $time:00"
                ]);
                return redirect()->route("flight.index")
                ->with("success","Un vol a été crée");
            }else{
                return redirect()->route("flight.create")
                ->with("error","Aucun avion avec cette immatriculation n'as été trouvé");
            }

        }else{
            return redirect()->route("flight.create")
            ->with("error","L'imatriculation n'est pas juste");
        }


        //Flight::create($request->all());

    }

    public function show($id) {
        $flight = Flight::findOrFail($id);
        return view("flight",["flight"=>$flight]);
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
