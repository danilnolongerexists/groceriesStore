<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;

Route::get('/', [ViewsController::class, 'index'])->name('index');
