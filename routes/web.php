<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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


Route::get('/fake', [MainController::class, 'fake']);

//Route::middleware(['guest', 'admin'])->group(function () {
    Route::get('/', [MainController::class,'index'])->middleware('auth');
//});


Route::get('/register', [MainController::class,'register_view'])->middleware('guest');
Route::get('/login', [MainController::class, 'login_view'])->middleware('guest')->name('login');
Route::get('/logout', [MainController::class, 'logout'])->middleware('auth');

Route::get('/profile/{id}', [UserController::class,'show_profile'])->middleware('auth');
Route::get('/status/{id}', [UserController::class,'edit_status_view'])->middleware('auth');
Route::get('/security/{id}', [UserController::class, 'edit_security_view'])->middleware('auth');
Route::get('/media/{id}', [UserController::class, 'edit_media_view'])->middleware('auth');;
Route::get('/edit/{id}', [UserController::class, 'edit_userinfo_view'])->middleware('auth');
Route::get('/create', [UserController::class, 'create_user_view'])->middleware('auth');
Route::get('/delete/{id}', [UserController::class, 'delete_user'])->middleware('auth');

Route::post('/login_handler', [MainController::class,'login_handler'])->middleware('guest');;
Route::post('/register_handler', [MainController::class, 'register_handler'])->middleware('guest');
Route::post('/create_handler', [UserController::class, 'create_handler'])->middleware('auth');
Route::post('/edit_handler', [UserController::class, 'edit_handler'])->middleware('auth');
Route::post('/media_handler', [UserController::class, 'media_handler'])->middleware('auth');
Route::post('/security_handler', [UserController::class, 'security_handler'] )->middleware('auth');
Route::post('/status_handler', [UserController::class, 'status_handler'])->middleware('auth');
