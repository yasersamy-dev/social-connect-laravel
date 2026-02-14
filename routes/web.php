<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Auth\LoginController;
use App\Http\Controllers\web\Auth\RegisterController;
use App\Http\Controllers\web\Auth\LogoutController;
use App\Http\Controllers\web\Auth\ForgotPasswordController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\Web\Post\PostController;
use App\Http\Controllers\Web\Post\CommentController;
use App\Http\Controllers\Web\Post\LikeController;
use App\Http\Controllers\Web\FriendController;



// Auth
//login
Route::get('/',[LoginController::class,'ShowLoginForm'])->name('ShowLoginForm');
Route::post('/',[LoginController::class,'login'])->name('login');
//register
Route::get('/register',[RegisterController::class,'ShowRegisterForm'])->name('ShowRegisterForm');
Route::post('/register',[RegisterController::class,'register'])->name('register');
//logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');


// posts comment like friend forgotpassword
Route::middleware('auth')->group(function () {
    // forgot pawword 
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

    //postss
    Route::resource('posts', PostController::class);
    Route::post('/posts/{post}/comments',[CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}',[CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');
    // friend
    Route::post('/friends/{user}', [FriendController::class, 'send']) ->name('friends.send');
    
    Route::post('/friend-request/{request}/accept', [FriendController::class, 'accept'])->name('friends.accept');
    
    Route::post('/friend-request/{request}/reject', [FriendController::class, 'reject'])->name('friends.reject');
    //search
    Route::get('/search', [FriendController::class, 'search'])->name('friends.search');

    //view friends
    Route::get('/friends', [FriendController::class,'friends'])->name('friends.index');


});


//Profile
Route::middleware('auth')->group(function () {
Route::get('/profile',[ProfileController::class,'ShowProfile'])->name('ShowProfile');
Route::get('/profile/edit',[ProfileController::class,'edit'])->name('profile.edit');
Route::put('/profile/update',[ProfileController::class,'update'])->name('profile.update');
});



