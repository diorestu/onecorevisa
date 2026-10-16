<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');
Route::get('/llms.txt', [HomeController::class, 'llms'])->name('llms');
Route::get('/lang/{locale}', [HomeController::class, 'switchLang'])->name('lang.switch');
Route::post('/consultation', [HomeController::class, 'submitConsultation'])->name('consultation.submit');

Route::get('/services/{service}', [HomeController::class, 'showService'])->name('services.show');

Route::get('/services/{category}/{service}', [HomeController::class, 'showServiceLine'])->name('services.detail');
