<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->verifyId($id))
            return redirect('/')->with('error', 'wrong id mate');
        return view('editUser');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!UserController::verifyId($id))
            return redirect('/')->with('error', 'wrong id mate');

        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'surname' => ['required', 'min:3', 'max:30'],
            'phone_number' => ['required', 'numeric', 'regex:/\d{3}\s?\d{3}\s?\d{2}\s?\d{2}/u'],
        ]);

        User::findOrFail($id)->update($request->all());
        return redirect()->route('home')
        ->with('success','Votre compte a été mis à jour');
    }


    /**
     * Update the password of the specified resource in storage.
     *
     * Hand made function, hope it works
     */
    public function update_email(Request $request, $id)
    {
        if (!UserController::verifyId($id))
            return redirect('/')->with('error', 'wrong id mate');

        $request->validate([
            'email' => ['required', 'email', 'confirmed', 'unique:users,email'],
        ]);

        User::findOrFail($id)->update($request->all());
        return redirect()->route('home')
        ->with('success','Votre adresse mail a été mis à jour');
    }

    /**
     * Update the password of the specified resource in storage.
     *
     * Hand made function, hope it works
     */
    public function update_password(Request $request, $id)
    {
        if (!UserController::verifyId($id))
            return redirect('/')->with('error', 'wrong id mate');

        $request->validate([
            'password' => ['required', 'min:7', 'max:30', 'confirmed'],
        ]);

        User::findOrFail($id)->update($request->all());
        return redirect()->route('home')
        ->with('success','Votre mot de passe a été mis à jour');
    }

    /**
     * Show page to manage all users
     */
    public function manage()
    {
        if (UserController::isConnected() || auth()->user()->is_RDZ)
        {
            return view('manage_users');
        }
        return redirect()->route('home')
        ->with('error', 'Vous n\'avez pas les droits pour cela');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * verify the current connected user is the same user the connected user tries to modify
     *
     * => if $id == connected_user()->id...
     */
    public static function verifyId($id)
    {
        return UserController::isConnected() && $id == auth()->user()->id;
    }

    /**
     * return if the user is connected
     */
    public static function isConnected()
    {
        return auth()->check();
    }
}
