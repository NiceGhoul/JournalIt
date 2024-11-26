<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeditationController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'showHomePage'])->name('homePage');
Route::get('/ProfilePage', [UserController::class, 'profile'])->name('ProfilePage')->middleware('auth');

Route::patch('/to-do-lists/{id}/update-progress', [ToDoListController::class, 'updateProgress'])->name('updateProgress');

Route::post('/logout', [UserController::class, 'accountLogout'])->name('logout');
Route::get('/login', [UserController::class, 'getLoginPage'])->name('login');
Route::post('/login', [UserController::class, 'accountLogin'])->name('loginAccount');
Route::get('/register', [UserController::class, 'showRegisterPage'])->name('showRegister');
Route::post('/register', [UserController::class, 'store'])->name('registerAccount');

Route::post('/upload-profile-picture', [UserController::class, 'uploadProfilePicture'])->name('uploadProfilePicture');
Route::get('/meditation', [MeditationController::class, 'showMeditationPage'])->name('meditationPage');

Route::get('/todolist', [ToDoListController::class, 'show'])->name('ToDoList');
Route::post('/addtodolist', [ToDoListController::class, 'store'])->name('AddToDoList');
