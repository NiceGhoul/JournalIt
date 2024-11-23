<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [UserController::class, 'getLoginPage'])->name('login');
Route::get('/register', [UserController::class, 'showRegisterPage'])->name('showRegister');
Route::post('/register', [UserController::class, 'store'])->name('registerAccount');