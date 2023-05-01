<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        $users = \App\Models\User::get()->all();
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

    $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:3',
        'image' => 'file|image|max:20048',
    ];

    $messages = [
        'email.required' => 'Введите email',
        'email.unique' => 'Такой email уже занят, придумайте другой',
        'password.required' => 'Введите password, это обязательно',
        'password.min' => 'Пароль слишком короткий, нужно минимум 3 символа'
    ];

    $request->validate($rules, $messages);


    $user = \App\Models\User::create([
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password'))
    ]);


    //profile
    \App\Models\User::find($user->id)->update([
        'city'=>$request->city,
        'country'=>$request->country,
        'address'=>$request->address,
        'phone'=>$request->phone,
        'inst'=>$request->inst,
        'vk'=>$request->vk,
        'tg'=>$request->tg,
        'job'=>$request->job,
        'company'=>$request->company,
        'username'=>$request->username
    ]);



    //media

    $image = $request->file('image');
    $filename = $image->store('/uploads');

    \App\Models\User::find($user->id)->update([
        'avatar'=>"/".$filename,
    ]);

    // status
    $record = \App\Models\Status::where('title', $request->status)->first();

    \App\Models\User::find($user->id)->update([
        "status_id" => $record->id
    ]);






    return redirect('/')->with('success', 'Регистрация нового пользователя успешна');
})->middleware('auth');

Route::post('/edit_handler', function (Request $request) {
    $user = \App\Models\User::find($request->id);
    $user->update($request->all());
    return redirect('/');
})->middleware('auth');

Route::post('/media_handler', function (Request $request) {

    $image = $request->file('image');
    $filename = $image->store('/uploads');

    $user =\App\Models\User::find($request->id);
    Storage::delete($user->avatar);

    $user->update([
       'avatar'=>"/".$filename,
    ]);

    return redirect('/')->with("success", "Аватар успешно обновлен");
})->middleware('auth');

Route::post('/security_handler', function (Request $request) {

    $rules = [
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($request->id),
        ],
        'password' => 'required|string|min:3|confirmed',
        'password_confirmation' => 'required|string|min:3',
    ];

    $messages = [
        'email.unique' => 'Такой email уже занят, придумайте другой',
        'password.required' => 'Введите password, это обязательно',
        'password.min' => 'Пароль слишком короткий, нужно минимум 3 символа',
        'password.confirmed' => 'Пароли не совпадают',
        'password_confirmation' => 'Пароли не совпадают',
    ];

    $request->validate($rules, $messages);

    \App\Models\User::find($request->id)->update([
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/')->with('success', 'Безопасность успешно обновлена');;
})->middleware('auth');

Route::post('/status_handler', function (Request $request) {

    $record = \App\Models\Status::where('title', $request->status)->first();

    \App\Models\User::find($request->id)->update([
        "status_id" => $record->id
    ]);

    return redirect('/')->with('success', 'Статус успешно обновлен');
})->middleware('auth');


Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('/logout', function(){
   \Illuminate\Support\Facades\Auth::logout();
   return redirect('/');
})->middleware('auth');

Route::get('/profile/{id}', function ($id) {
    $user = User::find($id);
    return view('user_profile', ['user'=>$user]);
})->middleware('auth');

Route::get('/status/{id}', function ($id) {
    $user=\App\Models\User::find($id);
    return view('user_status', ['user'=>$user]);
})->middleware('auth');

Route::get('/security/{id}', function ($id, Request $request) {
    $user = User::find($id);
    return view('/user_security', ['user'=>$user]);
})->middleware('auth');


Route::get('/media/{id}', function ($id) {
    $user = \App\Models\User::find($id);
    return view('/user_media',['user'=>$user]);
})->middleware('auth');;


Route::get('/edit/{id}', function ($id) {
    $user = User::find($id);
    return view('/edit',['user'=>$user]);
})->middleware('auth');

Route::get('/create', function () {
    return view('/create_user');
})->middleware('auth');

Route::get('/delete/{id}', function ($id) {
    $user =\App\Models\User::find($id);
    Storage::delete($user->avatar);
    $user->delete();
    return redirect('/')->with("success","Пользователь успешно удален");
})->middleware('auth');
