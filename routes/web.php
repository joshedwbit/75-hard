<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/home', [HomeController::class, 'Home']);

// auth
Route::get('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::post('/new-user', [UserController::class, 'registerNewUser']);

Route::post('/entry-submitted', [HomeController::class, 'entrySubmitted']);
