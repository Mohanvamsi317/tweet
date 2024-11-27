<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Public Routes
Route::get('/', function () {
    return view('auth.register');
})->name('reg');

Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [RegisterController::class, 'authenticate'])->name('login.submit');



Route::group(['middleware' => 'admin'], function () {
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('/setting',[DashboardController::class,'setting'])->name('setting');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/share-tweet', [DashboardController::class, 'share'])->name('share-tweet');
    Route::post('/create-tweet', [DashboardController::class, 'postTweet'])->name('create-tweet'); // Handle form submission
    Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy'); // Correct method name
    Route::get('/tweet-view/{id}', [DashboardController::class,'show'])->name('tweet-view.show');

    Route::get('/posts', [DashboardController::class, 'display'])->name('posts');

    Route::get('/profile', [DashboardController::class,'profile'])->name('profile');




    Route::post('/profile-update', [DashboardController::class, 'update'])->name('profile.update');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{friendId}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');

    Route::post('/chat/{friend}/send', [ChatController::class, 'send'])->name('chat.send');


    Route::post('/updatelike/{user_id}/{post_id}', [DashboardController::class, 'updatelikes']);
});

// Authentication Routes
require __DIR__.'/auth.php';
