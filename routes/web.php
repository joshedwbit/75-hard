<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/home', [HomeController::class, 'Home']);
Route::get('/login', [UserController::class, 'login']);
Route::get('register', [UserController::class, 'register']);

Route::post('/entry-submitted', [HomeController::class, 'entrySubmitted']);
