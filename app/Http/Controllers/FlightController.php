<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Plane;
use App\Models\User;
use App\Http\Controllers\UserController;

use function PHPUnit\Framework\isNull;

class FlightController extends Controller
{
    public function index() {
        $flights = Flight::orderBy('departure', 'asc')->get();
        return view('schedule', ['flights' => $flights, "user" => auth()->user()]);
    }

    public function create(){
        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

        $planes = Plane::all(); //To give a selection to the user
        return view("newFlightForm", ['planes' => $planes]);
    }

    public function store(Request $request){

        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

            $request->validate([
            'plane' => "required|min:1",
            'departure'=> "required|date_format:H:i",
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

        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

        $flight = Flight::findOrFail($id);
        $users = User::all(); //For suggestions to add user to flight
        return view("editFlight",["flight" => $flight,"users" => $users]);
    }

    public function update(Request $request, $id){

        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

        $request->validate([
            'departure'=> "required|date_format:H:i",
        ]);
        $time= $request->input("departure");
        Flight::findOrFail($id)->update(["departure" => date("Y-m-d") . " $time:00"]);
        return redirect()->route('flight.index')
        ->with('success','Vol a été mis à jour');
    }

    public function destroy($id){

        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

        $flight = Flight::findOrFail($id);
        $flight->delete();
        return redirect()->route('flight.index')
                    ->with('success','Vol supprimé');
    }

    public function removePassenger(Request $request){
        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'user_id'=> 'required|exists:users,id',
        ]);
        $f = Flight::find($request->input("flight_id"));
        $f->users()->detach($request->input("user_id"));

        return redirect()->route('flight.edit',$request->input("flight_id"))
                    ->with('success','Utilisteur enlevé');
    }

    public function addPassenger(Request $request){
        if (! UserController::isConnected() || !auth()->user()->is_RDZ)
            return redirect('/')->with('error', 'Vous n\'avez pas les droits');

        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'email' => 'required|exists:users,email',
        ]);

        $f = Flight::find($request->input("flight_id"));
        $u = User::where("email","=",$request->input("email"))->first();
        $f->users()->attach($u->id);

        return redirect()->route('flight.edit',$request->input("flight_id"))
                    ->with('success','Utilisteur ajouté');
    }

    public function join(Request $request){
        
        if (!UserController::isConnected()){
            return redirect('/')->with('error', 'Vous n\'êtes pas connecté');
        }

        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'flight_type'=>'required|numeric|in:1500,4000',
        ]);
        $flight = Flight::findOrFail($request->input("flight_id"));
        
        //Check if flight is departed
        if(strtotime($flight->departure) < time()){
            
            return redirect()->route('flight.index')
            ->with('error',"Ce vol n'est plus rejoinable");
        }

        //Check flight space
        
        
        if(count($flight->users) >= $flight->plane->seat_count){ //Plane full
            
            return redirect()->route('flight.index')
            ->with('error',"Ce vol est complet");
        }

        
       
        //Check if user is already in flight
        $user = auth()->user();
        if(FlightController::in_flight($user,$flight)){
            
            return redirect()->route('flight.index')
            ->with('error',"Vous êtes déja dans ce vol");
        }

        //Check user credits
        $type = $request->input("flight_type");
        
        
        if($type == 4000) {
            if($user->credits4000 > 0){
                $user->update(["credits4000"=> $user->credits4000 - 1]);
                $flight->users()->attach($user->id);
                return redirect()->route('flight.index')
                    ->with('success',"Vol rejoin avec success");
            }
        }else if($type == 1500){
            if($user->credits1500 > 0){
                $user->update(["credits1500"=> $user->credits1500 - 1]);
                $flight->users()->attach($user->id);
                return redirect()->route('flight.index')
                    ->with('success',"Vol rejoin avec success");
            }
        }
        
        return redirect()->route('flight.index')
            ->with('error',"Crédits insufisant");
    }

    public static function in_flight($user,$flight){
        foreach($flight->users as $u){
            if($u->id == $user->id)
                return true;
        }
        return false;
    }
}
