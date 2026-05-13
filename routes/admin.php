<?php

use App\Http\Controllers\Admin\CompressorModelsController;
use App\Http\Controllers\Admin\CompressorsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\OptionPostsController;
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
    Route::post('{compressor:name_slug}/models/create', [CompressorModelsController::class, 'create']);
    Route::post('{compressor:name_slug}/models/{model}/update', [CompressorModelsController::class, 'update']);
    Route::post('{compressor:name_slug}/models/{model}/delete', [CompressorModelsController::class, 'delete']);

    Route::view('{compressor:name_slug}', 'admin.compressors.item');
});

Route::prefix('options')->group(function () {
    Route::view('/', 'admin.options.list');
    Route::get('/getList', [OptionsController::class, 'getList']);

    Route::view('create', 'admin.options.item');
    Route::post('create', [OptionsController::class, 'create']);
    Route::get('{option:name_slug}/read', [OptionsController::class, 'read']);
    Route::post('{option:name_slug}/update', [OptionsController::class, 'update']);
    Route::post('{option:name_slug}/delete', [OptionsController::class, 'delete']);
    Route::post('{option:name_slug}/posts/create', [OptionPostsController::class, 'create']);
    Route::post('{option:name_slug}/posts/{post:name_slug}/update', [OptionPostsController::class, 'update']);
    Route::post('{option:name_slug}/posts/{post:name_slug}/delete', [OptionPostsController::class, 'delete']);

    Route::view('{option:name_slug}', 'admin.options.item');
});

Route::prefix('news')->group(function () {
    Route::view('/', 'admin.news.list');
    Route::get('/getList', [NewsController::class, 'getList']);

    Route::view('create', 'admin.news.item');
    Route::post('create', [NewsController::class, 'create']);
    Route::get('{news:name_slug}/read', [NewsController::class, 'read']);
    Route::post('{news:name_slug}/update', [NewsController::class, 'update']);
    Route::post('{news:name_slug}/delete', [NewsController::class, 'delete']);

    Route::view('{news:name_slug}', 'admin.news.item');
});
