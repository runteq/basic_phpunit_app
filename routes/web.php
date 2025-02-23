<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [TaskController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store']);

Route::get('/mypage', [UserController::class, 'mypage'])->middleware('auth')->name('mypage');

Route::get('/profile/edit', [UserController::class, 'editProfile'])->middleware('auth')->name('profile.edit');

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('tasks', TaskController::class)->middleware('auth');
