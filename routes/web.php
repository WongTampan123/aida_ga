<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;

//Get
Route::get('/', [PageController::class, 'showPage']);
Route::get('/dashboard', [PageController::class, 'showDashboard']);
Route::get('/dashboard/{category_type}', [PageController::class, 'showDashboardCategory']);
Route::get('/dashboard/{category_type}/{subcategory_type}', [PageController::class, 'showAssetList']);
Route::get('/dashboard/{category_type}/{subcategory_type}/add_asset', [PageController::class, 'showAddAssetForm']);

//Post
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
