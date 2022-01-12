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

    public function update_from_admin(Request $request, $id)
    {
        // verify the connected user is admin
        if (!UserController::isConnected() || !auth()->user()->is_RDZ || auth()->user()->id != $id)
            return redirect()->route('home')
            ->with('error', 'Vous n\'avez pas les droits pour cela');

        // update specified user

        $attributes = $request->validate([
            'id' => ['required', 'integer', 'min:0'],
            'name' => ['required', 'min:3', 'max:30'],
            'surname' => ['required', 'min:3', 'max:30'],
            'phone_number' => ['required', 'numeric', 'regex:/\d{3}\s?\d{3}\s?\d{2}\s?\d{2}/u'],
            'email' => ['required', 'email', 'email'],
            'credits1500' => ['required', 'integer', 'min:0'],
            'credits4000' => ['required', 'integer', 'min:0']
        ]);

        $users = User::where('id', '=', $request->input('id'))->get();
        if ($users->count() != 1)
            dd('error');

        // user to modify
        $user = $users[0];

        // verify the new mail is not taken
        if ($request->input('email') != $user->email) {
            $users = User::where('email', '=', $request->input('email'))->get();
            // is length is not 0 => the mail is already taken
            if ($users->count() != 0)
                return redirect()->back()->withErrors(['email' => 'email already in use']);
        }

        $user->update($attributes);
        $user->update(['is_RDZ' => $request->has('isRDZ')]);

        return redirect()->route('home')
        ->with('success', 'user updated');
    }

    public function update_password_from_admin(Request $request, $id)
    {
        // verify the connected user is admin
        if (!UserController::isConnected() || !auth()->user()->is_RDZ || auth()->user()->id != $id)
            return redirect()->route('home')
            ->with('error', 'Vous n\'avez pas les droits pour cela');

        // update specified user

        $attributes = $request->validate([
            'password' => ['required', 'min:7', 'max:30', 'confirmed',],
        ]);

        $users = User::where('id', '=', $request->input('id'))->get();
        if ($users->count() != 1)
            dd('error');

        // user to modify
        $user = $users[0];

        // verify the new mail is not taken
        if ($request->input('email') != $user->email) {
            $users = User::where('email', '=', $request->input('email'))->get();
            // is length is not 0 => the mail is already taken
            if ($users->count() != 0)
                return redirect()->back()->withErrors(['email' => 'email already in use']);
        }

        $user->update($attributes);

        return redirect()->route('home')
        ->with('success', 'user updated');
    }

    /**
     * Show page to manage all users
     */
    public function manage()
    {
        if (UserController::isConnected() && auth()->user()->is_RDZ)
        {
            return view('manage_users', ['users' => User::all()]);
        }
        return redirect()->route('home')
        ->with('error', 'Vous n\'avez pas les droits pour cela');
    }


    public function manage_ajax(Request $request)
    {
        if (UserController::isConnected() && auth()->user()->is_RDZ)
        {
            $users = User::where('email', '=', $request->input('mail'))->get();
            if ($users->count() == 1) {
                $user = $users[0];

                return response()->json([
                    'id' => $user->id,
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'isRDZ' => $user->is_RDZ,
                    'credits1500' => $user->credits1500,
                    'credits4000' => $user->credits4000
                ]);
            }

            return response()->json([
                'message' => 'Database error.'
            ], 500);
        }
        return null;
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
