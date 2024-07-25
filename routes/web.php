<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InventarisController;
use App\Http\Middleware\CheckSession;

Route::get('/', [PageController::class, 'showPage'])->name('login')->withoutMiddleware([CheckSession::class]);
Route::post('/login', [UserController::class, 'login'])->withoutMiddleware([CheckSession::class]);
Route::post('/logout', [UserController::class, 'logout'])->withoutMiddleware([CheckSession::class]);

Route::middleware([CheckSession::class])->group(function(){
    Route::get('/dashboard', [PageController::class, 'showDashboard']);
    Route::get('/bulk_upload', [PageController::class, 'showBulkUpload']);
    Route::get('/dashboard/{category_type}', [PageController::class, 'showDashboardCategory']);
    Route::get('/dashboard/{category_type}/{subcategory_type}', [PageController::class, 'showAssetList']);
    Route::get('/dashboard/{category_type}/{subcategory_type}/add_asset', [PageController::class, 'showAddAssetForm']);
    Route::get('/dashboard/{category_type}/{subcategory_type}/{asset_id}', [PageController::class, 'showEditAssetForm']);

    Route::post('/add_asset',[InventarisController::class, 'saveNewAsset']);
});

