<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeditationController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\AchievementController;
use Illuminate\Support\Facades\Route;

// Public Routes
// Route::get('/', [HomeController::class, 'showHomePage'])->name('homePage');
Route::get('/login', [UserController::class, 'getLoginPage'])->name('login');
Route::post('/login', [UserController::class, 'accountLogin'])->name('loginAccount');
Route::get('/register', [UserController::class, 'showRegisterPage'])->name('showRegister');
Route::post('/register', [UserController::class, 'store'])->name('registerAccount');

// Authenticated Routes (Protected by 'auth' middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'showHomePage'])->name('homePage');
    Route::get('/ProfilePage', [UserController::class, 'profile'])->name('ProfilePage');
    Route::post('/logout', [UserController::class, 'accountLogout'])->name('logout');
    Route::post('/upload-profile-picture', [UserController::class, 'uploadProfilePicture'])->name('uploadProfilePicture');
    
    // To-Do List Routes
    Route::get('/todolist', [ToDoListController::class, 'show'])->name('ToDoList');
    Route::get('/todolist/history', [ToDoListController::class, 'showHistory'])->name('ToDoListHistory');
    Route::post('/addtodolist', [ToDoListController::class, 'store'])->name('AddToDoList');
    Route::patch('/to-do-lists/{id}/update-progress', [ToDoListController::class, 'updateProgress'])->name('updateProgress');

    // Meditation Page
    Route::get('/meditation', [MeditationController::class, 'showMeditationPage'])->name('meditationPage');

    // Achievement Page
    Route::get('/achievement', [AchievementController::class, 'showAchievementPage'])->name('achievementPage');
});
