<?php

use App\Http\Controllers\AnalyticController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'showHomePage'])->name('homePage');
    Route::get('/ProfilePage', [UserController::class, 'profile'])->name('ProfilePage');
    Route::post('/logout', [UserController::class, 'accountLogout'])->name('logout');
    Route::post('/upload-profile-picture', [UserController::class, 'uploadProfilePicture'])->name('uploadProfilePicture');
    Route::post('/update-bio', [UserController::class, 'updateBio'])->name('update.bio');

    Route::get('/todolist', [ToDoListController::class, 'show'])->name('ToDoList');
    Route::get('/todolist/history', [ToDoListController::class, 'showHistory'])->name('ToDoListHistory');
    Route::post('/addtodolist', [ToDoListController::class, 'store'])->name('AddToDoList');
    Route::patch('/to-do-lists/{id}/update-progress', [ToDoListController::class, 'updateProgress'])->name('updateProgress');
    Route::delete('/deletetodolist/{id}', [ToDoListController::class, 'destroy'])->name('DeleteToDoList');


    // meditation page
    Route::get('/meditation', [MeditationController::class, 'showMeditationPage'])->name('meditationPage');
    Route::get('/meditation/history', [MeditationController::class, 'showHistory'])->name('meditationPage.history');
    Route::post('/addmeditation', [MeditationController::class, 'storeMeditate'])->name('AddMeditation');
    Route::get('/meditation/counter/{id}', [MeditationController::class, 'showCounter'])->name('meditation.counter');
    Route::get('/meditation/counter/delete/{id}', [MeditationController::class, 'deleteSession'])->name('meditation.delete');
    Route::post('/meditation/{id}/start', [MeditationController::class, 'startMeditation'])->name('meditation.start');
    Route::post('/meditation/{id}/stop', [MeditationController::class, 'stopMeditation'])->name('meditation.stop');

    // Achievement Page
    Route::get('/achievement', [AchievementController::class, 'showAchievementPage'])->name('achievementPage');

    // Analytic Page
    Route::get('/analytics', [AnalyticController::class, 'showAnalyticPage'])->name('analytics');
    Route::get('/analytics/data', [AnalyticController::class, 'fetchData'])->name('analyticsData');
});
