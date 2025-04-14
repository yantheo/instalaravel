<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/', [PostController::class, 'index'])->middleware('auth')->name('name');

Auth::routes();

//POST ROUTES
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::patch('/posts/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

//PROFILE ROUTES
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

//COMMENT ROUTES
Route::post('/post/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::delete('/post/{post}/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

//LIKES ROUTES
Route::post('/post/{post}/likes', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
Route::delete('/post/{post}/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy');
