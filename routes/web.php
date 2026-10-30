<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'create'])->name('login');
    Route::post('login', [AuthController::class, 'store'])->middleware('throttle:20,1');
    Route::middleware(EnsureAdmin::class)->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('articles/{id}/preview', [ArticleController::class, 'preview'])->whereNumber('id')->name('articles.preview');
        Route::get('{module}', [CmsController::class, 'index'])->name('cms.index');
        Route::get('{module}/create', [CmsController::class, 'create'])->name('cms.create');
        Route::post('{module}', [CmsController::class, 'store'])->name('cms.store');
        Route::get('{module}/{id}/edit', [CmsController::class, 'edit'])->whereNumber('id')->name('cms.edit');
        Route::put('{module}/{id}', [CmsController::class, 'update'])->whereNumber('id')->name('cms.update');
        Route::delete('{module}/{id}', [CmsController::class, 'destroy'])->whereNumber('id')->name('cms.destroy');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');
Route::get('/llms.txt', [HomeController::class, 'llms'])->name('llms');
Route::get('/lang/{locale}', [HomeController::class, 'switchLang'])->name('lang.switch');
Route::post('/consultation', [HomeController::class, 'submitConsultation'])->name('consultation.submit');

Route::get('/services/{service}', [HomeController::class, 'showService'])->name('services.show');

Route::get('/services/{category}/{service}', [HomeController::class, 'showServiceLine'])->name('services.detail');
