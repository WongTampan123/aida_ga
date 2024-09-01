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
    Route::get('/assets', [PageController::class, 'showAllAssetList']);
    Route::get('/get_asset_table', [PageController::class, 'getAssetTable']);
    Route::get('/search_asset', [InventarisController::class, 'searchAsset']);
    Route::get('/export_asset', [InventarisController::class, 'exportExcel']);
    Route::get('/assets/add_asset', [PageController::class, 'showAddAssetForm']);
    Route::get('/assets/{asset_id}', [PageController::class, 'showEditAssetForm']);
    Route::get('/bulk_upload', [PageController::class, 'showBulkUpload']);
    Route::get('/stock_take', [PageController::class, 'showStockTake']);
    Route::get('/get_stock_take_table', [PageController::class, 'getStockTakeTable']);
    Route::get('/search_stock_take', [InventarisController::class, 'searchStockTake']);
    Route::get('/download_template', [InventarisController::class, 'downloadTemplateBulkUpload']);
    Route::get('/dashboard/{category_type}', [PageController::class, 'showCategoryList']);
    Route::get('/dashboard/{category_type}/{subcategory_type}', [PageController::class, 'showAssetList']);
    Route::get('/dashboard/{category_type}/{subcategory_type}/add_asset', [PageController::class, 'showAddAssetForm']);
    Route::get('/dashboard/{category_type}/{subcategory_type}/{asset_id}', [PageController::class, 'showEditAssetForm']);

    Route::post('/add_asset',[InventarisController::class, 'saveNewAsset']);
    Route::post('/click_checkbox',[InventarisController::class, 'clickCheckbox']);
    Route::post('/update_asset',[InventarisController::class, 'updateAsset']);
    Route::post('/approval',[InventarisController::class, 'approvalAsset']);
    Route::post('/delete_asset',[InventarisController::class, 'deleteAsset']);
    Route::post('/save_bulk_upload',[InventarisController::class, 'saveBulkUpload']);
    Route::post('/save_image_bulk_upload',[InventarisController::class, 'saveImageBulkUpload']);
});

