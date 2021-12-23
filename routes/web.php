<?php


use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('login', [AuthController::class, 'login'])->name('auth.login');
// Route::post('login', [AuthController::class, 'login_check'])->name('login_check');
// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('register', [AuthController::class, 'register_ok'])->name('register_ok');

Route::resource('user', UserController::class);
Route::resource('flight', FlightController::class);
