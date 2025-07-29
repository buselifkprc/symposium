<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaperController;

Route::get('/', fn() => view('welcome'));

Route::get('/', function () {
    return view('welcome');
});
 Route::get('/sym', function () {
     return view('sym');
 });
Route::get('/home', function () {
    return view('panel.layout.app');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/papers', [PaperController::class, 'index'])->name('papers.index');
    Route::get('/papers/create', [PaperController::class, 'create'])->name('papers.create');
    Route::post('/papers', [PaperController::class, 'store'])->name('papers.store');
});
