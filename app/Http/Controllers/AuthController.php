<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    // GET
    public function login()
    {
        return view('login');
    }

    // POST
    public function login_check()
    {

    }

    // GET
    public function register()
    {
        return redirect()->route('user.create');
    }

    // POST
    public function register_ok()
    {
        dd('ok');
        return redirect()->route('/')->with('success', 'Vous avez été ajouté avec succès');
    }
}
