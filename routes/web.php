<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

// ダッシュボード（タスク一覧）のルートを追加
Route::get('/dashboard', [TaskController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('sign_up', [UserController::class, 'create'])->name('register');
Route::post('sign_up', [UserController::class, 'store']);

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('tasks', TaskController::class)->middleware('auth');

