<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LgaResultController;
use App\Http\Controllers\PollingUnitController;

Route::get('/', function () {
    return view('welcome');
});

// Polling Unit routes
Route::get('/polling-units', [PollingUnitController::class, 'index'])->name('polling-units.index');
Route::post('/polling-units/search', [PollingUnitController::class, 'index'])->name('polling-units.search');
Route::get('/polling-units/create', [PollingUnitController::class, 'create'])->name('polling-units.create');
Route::post('/polling-units', [PollingUnitController::class, 'store'])->name('polling-units.store');

// LGA routes
Route::get('/lga-results', [LgaResultController::class, 'index'])->name('lga.results');
Route::post('/lga-results', [LgaResultController::class, 'showResults'])->name('lga.results.show');
