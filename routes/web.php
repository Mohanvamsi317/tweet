<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthMiddileware;

Route::get('/', function () {
    return view('auth.register');
});

Route::group(['middleware' => 'admin'], function () {
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

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
});

require __DIR__.'/auth.php';
