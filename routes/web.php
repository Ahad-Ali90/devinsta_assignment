<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyticsDataController;


Route::prefix("analytics")->group(function () {
    Route::get('/', [AnalyticsDataController::class, 'index'])->name('analytics.index');
    Route::get('/create', [AnalyticsDataController::class, 'create'])->name('analytics.create');
    Route::post('/store', [AnalyticsDataController::class, 'store'])->name('analytics.store');
    Route::post('/show', [AnalyticsDataController::class, 'show'])->name('analytics.show');
});