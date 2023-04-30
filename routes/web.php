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


Route::get('fake/', function(){
   \App\Models\User::factory()->count(5)->create();
   return redirect()->back();
});

//Route::middleware(['guest', 'admin'])->group(function () {
    Route::get('/', function () {
        $users = User::all()->all();
        return view('users', ['users'=>$users]);
    })->middleware('auth');
//});


Route::get('/register', function () {
    return view('register');
})->middleware('guest');


Route::post('/login_handler', function (Request $request) {

    $rules = [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:3',
    ];

    $credentials = $request->validate($rules);


    if (\Illuminate\Support\Facades\Auth::attempt($credentials)){
        return redirect('/');
    }

    return redirect()->back()->withErrors([
        'email' => 'Неверные данные для входа',
    ])->withInput($request->except('password'));
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
})->middleware('guest');

Route::post('/create_handler', function (Request $request) {
    return redirect('/');
})->middleware('auth');

Route::post('/edit_handler', function (Request $request) {
    return redirect('/');
})->middleware('auth');

Route::post('/media_handler', function (Request $request) {
    return redirect('/');
})->middleware('auth');

Route::post('/security_handler', function (Request $request) {
    return redirect('/');
})->middleware('auth');

Route::post('/status_handler', function (Request $request) {
    return redirect('/');
})->middleware('auth');


Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('/logout', function(){
   \Illuminate\Support\Facades\Auth::logout();
   return redirect('/');
})->middleware('auth');

Route::get('/profile/{id}', function ($id) {
    dd(User::find($id));
    return view('user_profile');
})->middleware('auth');

Route::get('/status/{id}', function () {
    return view('user_status');
})->middleware('auth');

Route::get('/security/{id}', function () {
    return view('/user_security');
})->middleware('auth');


Route::get('/media/{id}', function () {
    return view('/user_media');
})->middleware('auth');;


Route::get('/edit/{id}', function () {
    return view('/edit');
})->middleware('auth');

Route::get('/create', function () {
    return view('/create_user');
})->middleware('auth');

Route::get('/delete/{id}', function () {
    return redirect('/');
})->middleware('auth');
