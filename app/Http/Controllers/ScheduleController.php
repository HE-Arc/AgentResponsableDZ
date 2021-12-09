<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index() {
        $flights = Flight::all();
        return view('schedule', ['flights' => $flights]);
    }
}
