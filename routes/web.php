<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'showHomePage'])->name('homePage');

Route::get('/login', [UserController::class, 'getLoginPage'])->name('showLogin');
Route::post('/login', [UserController::class, 'accountLogin'])->name('loginAccount');
Route::get('/register', [UserController::class, 'showRegisterPage'])->name('showRegister');
Route::post('/register', [UserController::class, 'store'])->name('registerAccount');