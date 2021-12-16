<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FlightController;

use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('users/{id}', function ($id) {
    return view('user',[
        'user' => User::findOrFail($id)
    ]);
});

Route::get("schedule",[FlightController::class,'index'])->name("Schedule");

Route::get('flight/{id}',[FlightController::class,'show'])->name("Flight");
