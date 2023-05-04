<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
    public function __construct(){
//        $this->images=$imageService;
    }

//    helpers
    public function fake() {
        User::factory()->count(5)->create();
        return redirect()->back();
    }



//    views
    public function index() {
        return view('users', ['users'=>User::get()->all()]);
    }

    //    auth
    public function register_view() {
        return view('register');
    }

    public function login_view () {
        return view('login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


//  handlers
    public function login_handler(Request $request){
        $rules = [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:3',
        ];

        $credentials = $request->validate($rules);

        if (Auth::attempt($credentials)){
            return redirect('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Неверные данные для входа',
        ])->withInput($request->except('password'));
    }

    public function register_handler(Request $request){
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

        User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect('/login')->with('success', 'Регистрация успешна');
    }



}
