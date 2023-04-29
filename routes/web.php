<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
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
    return view('users');
});

Route::get('/register', function () {
    return view('register');
});


Route::post('/login_handler', function (Request $request) {
    // dd($request);
    // dd($request->input('password'));
    return view('users');
});

Route::post('/register_handler', function (Request $request) {

    $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:3',
    ];

    $messages = [
        'email.required' => 'Введите email',
        'email.unique' => 'Такой email уже занят, придумайте другой',
        'password.required' => 'Введите password, это обязательно',
        'password.min' => 'Пароль слишком короткий, нужно минимум 3 символа'
    ];

    $request->validate($rules, $messages);

    \App\Models\User::create([
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password'))
    ]);

    return redirect('/login')->with('success', 'Регистрация успешна');
});

Route::post('/create_handler', function (Request $request) {
    return view('/users');
});

Route::post('/edit_handler', function (Request $request) {
    return view('/users');
});

Route::post('/media_handler', function (Request $request) {
    return view('/users');
});

Route::post('/security_handler', function (Request $request) {
    return view('/users');
});

Route::post('/status_handler', function (Request $request) {
    return view('/users');
});


Route::get('/login', function () {
    return view('login');
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
