<?php


use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;

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

Route::get('/', [FlightController::class, 'index'])->name('home');

Route::get('users/{id}', function ($id) {
    return view('user',[
        'user' => User::findOrFail($id)
    ]);
});

Route::resource('user', UserController::class);
Route::resource('flight', FlightController::class);
Route::post('flight/removepassenger',[FlightController::class,"removePassenger"])->name('flight.removePassenger');
