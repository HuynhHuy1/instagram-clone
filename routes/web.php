<?php

use App\Events\MessageEvent;
use App\Http\Controllers\Home\PostController;
use App\Http\Controllers\Home\ProfileController;
use App\Http\Controllers\Home\LikeController;
use App\Http\Controllers\Home\CommentController;
use App\Http\Controllers\Home\FollowController;
use App\Http\Controllers\Home\UserController;
use App\Http\Controllers\Home\MessageController;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::get('/post/get-more-post', [PostController::class, 'getMore']);
    Route::post('/', [PostController::class, 'create'])->name('create_post');
    Route::put('/{id}', [PostController::class, 'update'])->name('update_post');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('delete_post');

    //profile 
    Route::get('profile/{id}', [ProfileController::class, 'index'])->name('profile');


    //comment
    Route::get('post/{id}/comment', [PostController::class, 'getInfoPostDetail'])->name('post-detail');
    Route::post('post/{id}/comment', [CommentController::class, 'create'])->name('create_comment');
    Route::delete('post/{id}/comment', [CommentController::class, 'delete'])->name('delete_comment');

    //like
    Route::post('post/{id}/like', [LikeController::class, 'toggleLike'])->name('toggle-like');

    //profile
    Route::get('/user/{userName}', [ProfileController::class, 'search'])->name('get_user');
    Route::get('/profile/update/password', [ProfileController::class, 'showFormUpdatePassword'])->name('show-form-update-password');
    Route::get('/profile/update/profile', [ProfileController::class, 'showFormUpdateProfile'])->name('show-form-update-profile');
    Route::post('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('password_update');
    Route::put('/profile/update/profile', [ProfileController::class, 'updateProfile'])->name('profile_update');
    
    //follows
    Route::get('/follow/{userId}', [FollowController::class, 'toggleFollowing']);

    //chat
    Route::get('chat/chat', [MessageController::class, 'index']);
    Route::get('chat/chat/detail/{id}', [MessageController::class, 'chatDetail']);
    Route::post('chat/chat', [MessageController::class, 'create']);
});

require __DIR__ . '/auth.php';
