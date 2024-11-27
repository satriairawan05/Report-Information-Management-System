<?php

use Illuminate\Support\Facades\{Auth, Route};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing-page');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('folder', \App\Http\Controllers\Admin\FolderController::class)->except(['show']);
    Route::resource('report', \App\Http\Controllers\Admin\ReportController::class)->except(['show']);
    Route::get('report/{report}/download', [\App\Http\Controllers\Admin\ReportController::class, 'download'])->name('report.download');

    Route::prefix('setting')->group(function () {
        Route::resource('role', \App\Http\Controllers\Admin\Setting\GroupController::class)->except(['show'])->names('group');
        Route::resource('profile', \App\Http\Controllers\Admin\Setting\ProfileController::class)->only(['index', 'edit', 'update'])->names('profile');
    });
});
