<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'Home']);

Route::post('/entry-submitted', [HomeController::class, 'entrySubmitted']);
