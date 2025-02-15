<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', [TaskController::class, 'index'])->name('home');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('sign_up', [UserController::class, 'create'])->name('register');
Route::post('sign_up', [UserController::class, 'store']);

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('tasks', TaskController::class)->middleware('auth');
