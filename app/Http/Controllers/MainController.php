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

//    auth
    public function register() {
        return view('register');
    }

    public function login () {
        return view('login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

//    views
    public function index() {
        $users = User::get()->all();
        return view('users', ['users'=>$users]);
    }

    public function show_profile($id){
        $user = User::find($id);
        return view('user_profile', ['user'=>$user]);
    }

    public function edit_status($id){
        $user=User::find($id);
        return view('user_status', ['user'=>$user]);
    }

    public function edit_security($id, Request $request){
        $user = User::find($id);
        return view('/user_security', ['user'=>$user]);
    }

    public function edit_media($id){
        $user = User::find($id);
        return view('/user_media',['user'=>$user]);
    }

    public function edit_userinfo($id){
        $user = User::find($id);
        return view('/edit',['user'=>$user]);
    }

    public function create_user(){
        return view('/create_user');
    }

    public function delete_user($id){
        $user =User::find($id);
        Storage::delete($user->avatar);
        $user->delete();
        return redirect('/')->with("success","Пользователь успешно удален");
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

    public function create_handler(Request $request){
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

        //security
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);


        //profile
        User::find($user->id)->update([
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

        User::find($user->id)->update([
            'avatar'=>"/".$filename,
        ]);

        // status
        $record = Status::where('title', $request->status)->first();

        User::find($user->id)->update([
            "status_id" => $record->id
        ]);


        return redirect('/')->with('success', 'Регистрация нового пользователя успешна');
    }

    public function edit_handler(Request $request){
        $user = User::find($request->id);
        $user->update($request->all());
        return redirect('/');
    }

    public function media_handler(Request $request){
        $image = $request->file('image');
        $filename = $image->store('/uploads');

        $user =User::find($request->id);
        Storage::delete($user->avatar);

        $user->update([
            'avatar'=>"/".$filename,
        ]);

        return redirect('/')->with("success", "Аватар успешно обновлен");
    }

    public function security_handler(Request $request){
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

        User::find($request->id)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Безопасность успешно обновлена');;
    }

    public function status_handler (Request $request){
        $record = Status::where('title', $request->status)->first();

        User::find($request->id)->update([
            "status_id" => $record->id
        ]);

        return redirect('/')->with('success', 'Статус успешно обновлен');
    }

}
