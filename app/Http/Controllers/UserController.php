<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $userService, $user;

    public function __construct(UserService $userService){
        $this->userService=$userService;
    }

    //views
    public function show_profile($id){
        return view('user_profile', ['user'=>User::find($id)]);
    }

    public function edit_status_view($id){
        return view('user_status', ['user'=>User::find($id)]);
    }

    public function edit_security_view($id, Request $request){
        return view('/user_security', ['user'=>User::find($id)]);
    }

    public function edit_media_view($id){
        return view('/user_media',['user'=>User::find($id)]);
    }

    public function edit_userinfo_view($id){
        return view('/edit',['user'=>User::find($id)]);
    }

    public function create_user_view(){
        return view('/create_user');
    }


    //handlers
    public function create_handler(Request $request){
        $user = $this->userService->create_user($request);
        $this->userService->fill_profile($user, $request);
        $this->userService->fill_media($user, $request);
        $this->userService->fill_status($user, $request);
        return redirect('/')->with('success', 'Создан новый пользователь');
    }

    public function delete_user($id){
        $this->userService->delete_user($id);
        return redirect('/')->with("success","Пользователь удален");
    }

    public function edit_handler(Request $request){
        $this->userService->edit_userinfo($request);
        return redirect('/')->with("success", "Профиль успешно обновлен");
    }

    public function media_handler(Request $request){
        $this->userService->edit_media($request);
        return redirect('/')->with("success", "Аватар успешно обновлен");
    }

    public function security_handler(Request $request){
        $this->userService->edit_security($request);
        return redirect('/')->with('success', 'Профиль успешно обновлен');
    }

    public function status_handler (Request $request){
        $this->userService->edit_status($request);
        return redirect('/')->with('success', 'Статус успешно обновлен');
    }

}
