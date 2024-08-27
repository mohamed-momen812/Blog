<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/posts', [PostController::class,'index'])->name('posts.index'); // -> for shortcut

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // static route

Route::post('/posts', [PostController::class,'store'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])-> name('posts.show'); // {param}, dynamic route

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{post}', [PostController::class,'update'])->name('posts.update');

Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');

