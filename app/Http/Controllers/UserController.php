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
        if (!$this->verifyId($id))
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
        $request->validate([
            'password' => ['required', 'min:7', 'max:30', 'confirmed'],
        ]);

        User::findOrFail($id)->update($request->all());
        return redirect()->route('home')
        ->with('success','Votre adresse mail a été mis à jour');
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

    private function verifyId($id)
    {
        if ($id != auth()->user()->id)
        {
            return False;
        }
        return True;
    }
}
