<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'getBlade'])->name('home');

Route::view('login', 'auth.login')->name('login');
Route::post('login',  [LoginController::class, 'login']);

Route::get('logout',  [LoginController::class, 'logout'])->name('logout');

Route::post('/uploadFile', [AttachmentsController::class, 'uploadFile'])
    ->middleware('auth:admin');
