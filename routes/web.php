<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ============AUTHENTICATION ROUTES=====================
Route::middleware(['guest'])->group(function() {
    Route::get('/login',action:function() {
        return view('auth.login');
    })->name('login');

    Route::post('/login',[AuthController::class,'login'])->name('authenticate');

    Route::get('/signup',action:function() {
        return view('auth.signup');
    })->name('signup');

    Route::post('/signup',[AuthController::class,'register'])->name('register');
});

// ==================USER ROUTES===============================
Route::middleware(['auth'])->group(function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'],function() {
        Route::get('/all',[UserController::class,'index'])->name('all');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'room', 'as' => 'room.'],function() {
        Route::get('/{id}',[RoomController::class,'view'])->where('id','[0-9]+')->name('view');
        Route::get('/create',[RoomController::class,function() {
            return view('room.create');
        }])->name('create');
        Route::post('/store',[RoomController::class,'store'])->name('store');
    });
});


Route::get('/',[RoomController::class,'index'])->name('rooms');

// Route::get(uri:'/',action:'App\Http\Controllers\PusherController@index');
// Route::post(uri:'/broadcast',action:'App\Http\Controllers\PusherController@broadcast');
// Route::post(uri:'/receive',action:'App\Http\Controllers\PusherController@receive');