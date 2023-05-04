<?php

use App\Http\Controllers\MainController;
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

Route::get('/register', [MainController::class,'register'])->middleware('guest');

Route::post('/login_handler', [MainController::class,'login_handler'])->middleware('guest');;

Route::post('/register_handler', [MainController::class, 'register_handler'])->middleware('guest');

Route::post('/create_handler', [MainController::class, 'create_handler'])->middleware('auth');

Route::post('/edit_handler', [MainController::class, 'edit_handler'])->middleware('auth');

Route::post('/media_handler', [MainController::class, 'media_handler'])->middleware('auth');

Route::post('/security_handler', [MainController::class, 'security_handler'] )->middleware('auth');

Route::post('/status_handler', [MainController::class, 'status_handler'])->middleware('auth');

Route::get('/login', [MainController::class, 'login'])->middleware('guest')->name('login');

Route::get('/logout', [MainController::class, 'logout'])->middleware('auth');

Route::get('/profile/{id}', [MainController::class,'show_profile'])->middleware('auth');

Route::get('/status/{id}', [MainController::class,'edit_status'])->middleware('auth');

Route::get('/security/{id}', [MainController::class, 'edit_security'])->middleware('auth');

Route::get('/media/{id}', [MainController::class, 'edit_media'])->middleware('auth');;

Route::get('/edit/{id}', [MainController::class, 'edit_userinfo'])->middleware('auth');

Route::get('/create', [MainController::class, 'create_user'])->middleware('auth');

Route::get('/delete/{id}', [MainController::class, 'delete_user'])->middleware('auth');
