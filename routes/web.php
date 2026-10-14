<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', [HomeController::class, 'switchLang'])->name('lang.switch');
Route::post('/consultation', [HomeController::class, 'submitConsultation'])->name('consultation.submit');

Route::get('/services/{service}', [HomeController::class, 'showService'])->name('services.show');

Route::get('/services/{category}/{service}', [HomeController::class, 'showServiceLine'])->name('services.detail');
