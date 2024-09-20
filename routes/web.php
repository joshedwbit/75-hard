<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;

Route::get('/home', [HomeController::class, 'Home']);

// auth
Route::get('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::post('/new-user', [UserController::class, 'registerNewUser']);

Route::post('/create-entry', [LogController::class, 'createEntry']);

// edit/delete logs
Route::get('/edit-entry/{log}', [LogController::class, 'editEntry']);
Route::put('/edit-entry/{log}', [LogController::class, 'updateEntry']);
Route::delete('delete-entry/{log}', [LogController::class, 'deleteEntry']);