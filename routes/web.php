<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'showPage']);
Route::post('/login', [UserController::class, 'login']);
