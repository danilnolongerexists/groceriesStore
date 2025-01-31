<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\ActionsController;

Route::get('/', [ViewsController::class, 'index'])->name('index');

Route::post('/register', [ActionsController::class, 'register']);

Route::get('/login', [ViewsController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [ActionsController::class, 'login']);

Route::get('/logout', [ActionsController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/profile', [ViewsController::class, 'profile'])->name('profile')->middleware('auth');
