<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::post('/login', function (Request $request) {
    dd($request);
    dd($request->input('password'));
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/profile', function () {
    return view('user_profile');
});

Route::get('/status', function () {
    return view('user_status');
});

Route::get('/security', function () {
    return view('/user_security');
});


Route::get('/media', function () {
    return view('/user_media');
});


Route::get('/edit', function () {
    return view('/edit');
});

Route::get('/create', function () {
    return view('/create_user');
});


// register +
// login +
// users +

// create user +
// edit +
// user_media +
// user_security +
// user_status +
// user_profile +
