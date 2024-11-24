<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'showHomePage'])->name('homePage');
Route::get('/ProfilePage', [UserController::class, 'profile'])->name('ProfilePage');
Route::post('/logout', [UserController::class, 'accountLogout'])->name('logout');
Route::get('/login', [UserController::class, 'getLoginPage'])->name('showLogin');
Route::post('/login', [UserController::class, 'accountLogin'])->name('loginAccount');
Route::get('/register', [UserController::class, 'showRegisterPage'])->name('showRegister');
Route::post('/register', [UserController::class, 'store'])->name('registerAccount');
Route::post('/upload-profile-picture', [UserController::class, 'uploadProfilePicture'])->name('uploadProfilePicture');