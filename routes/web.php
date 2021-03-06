<?php


use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionController;
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

// Route::get('users/{id}', function ($id) {
//     return view('user',[
//         'user' => User::findOrFail($id)
//     ]);
// });



Route::get('register', [AuthController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [AuthController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionController::class, 'store'])->middleware('guest')->name('login');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('flight/removepassenger',[FlightController::class,"removePassenger"])->name('flight.removePassenger');
Route::post('flight/addpassenger',[FlightController::class,"addPassenger"])->name('flight.addPassenger');
Route::put('flight/join',[FlightController::class,"join"])->name('flight.join');
Route::put('flight/leave',[FlightController::class,"leave"])->name('flight.leave');

Route::resource('flight', FlightController::class);

// be carreful of order, if you put user/manage under Route::resource('user'), you can't access the page
Route::get('user/manage', [UserController::class, 'manage'])->middleware('auth')->name('user.manage');

// TODO: change to post
Route::get('user/user_manage_ajax', [UserController::class, 'manage_ajax'])->middleware('auth');

Route::put('user/update_email/{id}', [UserController::class, 'update_email'])->middleware('auth')->name('user.update_email');
Route::put('user/update_password/{id}', [UserController::class, 'update_password'])->middleware('auth')->name('user.update_password');
Route::put('user/update_from_admin/{id}', [UserController::class, 'update_from_admin'])->middleware('auth')->name('user.update_from_admin');
Route::put('user/update_password_from_admin/{id}', [UserController::class, 'update_password_from_admin'])->middleware('auth')->name('user.update_password_from_admin');
Route::resource('user', UserController::class);

