<?php

use App\Http\Controllers\Admin\CompressorsController;
use App\Http\Controllers\Admin\SidebarController;
use Illuminate\Support\Facades\Route;


Route::prefix('info')->group(function () {
    Route::view('/', 'admin.info')->name('admin.info');
});

Route::get('/sidebar-badges', [SidebarController::class, 'badges']);


Route::prefix('compressors')->group(function () {
    Route::view('/', 'admin.compressors.list');
    Route::get('/getList', [CompressorsController::class, 'getList']);

    Route::view('create', 'admin.compressors.item');
    Route::post('create', [CompressorsController::class, 'create']);
    Route::get('{compressor:name_slug}/read', [CompressorsController::class, 'read']);
    Route::post('{compressor:name_slug}/update', [CompressorsController::class, 'update']);
    Route::post('{compressor:name_slug}/delete', [CompressorsController::class, 'delete']);

    Route::view('{compressor:name_slug}', 'admin.compressors.item');
});
