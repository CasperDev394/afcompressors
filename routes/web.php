<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'getBlade'])->name('home');
Route::get('/contact', [HomeController::class, 'getContactBlade'])->name('contact');
Route::post('/contact/general', [HomeController::class, 'submitGeneralContact'])->name('contact.general.submit');
Route::post('/contact/quote-request', [HomeController::class, 'submitQuoteRequest'])->name('contact.quote.submit');
Route::get('/af-technology', [HomeController::class, 'getAfTechnologyBlade'])->name('af-technology');
Route::get('/solutions', [HomeController::class, 'getSolutionsBlade'])->name('solutions.index');
Route::get('/solutions/{category}', [HomeController::class, 'getSolutionsCategoryBlade'])->name('solutions.category');
Route::get('/solutions/{category}/data', [HomeController::class, 'readSolutionsCategory'])->name('solutions.category.read');
Route::get('/options', [HomeController::class, 'getOptionsBlade'])->name('options.index');
Route::get('/options/data', [HomeController::class, 'readOptions'])->name('options.index.read');
Route::get('/options/{option:name_slug}', [HomeController::class, 'getOptionBlade'])->name('options.show');
Route::get('/options/{option:name_slug}/data', [HomeController::class, 'readOption'])->name('options.read');

Route::view('login', 'auth.login')->name('login');
Route::post('login',  [LoginController::class, 'login']);

Route::get('logout',  [LoginController::class, 'logout'])->name('logout');

Route::post('/uploadFile', [AttachmentsController::class, 'uploadFile'])
    ->middleware('auth:admin');
