<?php


use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionController;

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

Route::resource('flight', FlightController::class);


Route::get('register', [AuthController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [AuthController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionController::class, 'store'])->middleware('guest')->name('login');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('flight/removepassenger',[FlightController::class,"removePassenger"])->name('flight.removePassenger');
Route::post('flight/addpassenger',[FlightController::class,"addPassenger"])->name('flight.addPassenger');
