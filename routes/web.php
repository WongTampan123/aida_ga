<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;

//Get
Route::get('/', [PageController::class, 'showPage']);
Route::get('/dashboard', [PageController::class, 'showDashboard']);

//Post
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
