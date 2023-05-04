<?php

namespace App\Services;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserService{
    private $imageService;

    public function __construct(ImageService $imageService){
        $this->imageService=$imageService;
    }

    public function create_user($request){
        $this->create_user_validate($request);
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        return $user;
    }

    public function create_user_validate($request){
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
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        if(isset($user->avatar)){
            Storage::delete($user->avatar);
        }
        $user->delete();
    }

    public function edit_userinfo($request){
        $user = User::find($request->id);
        $user->update($request->all());
    }

    public function edit_media($request){
        $this->imageService->validate($request);
        $user = User::find($request->id);
        $this->imageService->delete($user);
        $this->imageService->update($user, $request->file('image'));
    }

    public function edit_security($request){
        $this->security_validate($request);

        User::find($request->id)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return true;
    }

    public function security_validate($request){
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

        return true;
    }

    public function edit_status($request){
        $record = Status::where('title', $request->status)->first();
        User::find($request->id)->update([
            "status_id" => $record->id
        ]);
        return true;
    }

    public function fill_profile(User $user, Request $request){
        $user->update([
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
    }

    public function fill_media(User $user, Request $request){
        $this->imageService->validate($request);
        $this->imageService->update($user, $request->file('image'));
    }

    public function fill_status(User $user, Request $request){
        $record = Status::where('title', $request->status)->first();
        $user->update([
            "status_id" => $record->id
        ]);
    }

}
