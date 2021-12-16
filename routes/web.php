<?php

use App\Http\Controllers\ScheduleController;
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

Route::get('/', [ScheduleController::class, 'index'])->name('welcome');
Route::get("schedule", [ScheduleController::class,'index'])->name("schedule");

Route::get('users/{id}', function ($id) {
    return view('user',[
        'user' => User::findOrFail($id)
    ]);
});

Route::resource('user', UserController::class);
