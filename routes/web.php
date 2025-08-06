<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KullaniciController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('panel.layout.app');})->name('dashboard');
});

//Paper Yönetimi
Route::group(['prefix' => 'paper'], function () {
    Route::get('index', [KullaniciController::class, 'paperindex'])->name('kullanici.PaperIndex');
    Route::get('create', [KullaniciController::class, 'papercreatePage'])->name('kullanici.PaperCreate');
    Route::post('add', [KullaniciController::class, 'paperadd'])->name('kullanici.PaperAdd');
    Route::get('update/{id}', [KullaniciController::class, 'paperupdatepage'])->name('kullanici.PaperUpdatePage');
    Route::post('/update', [KullaniciController::class, 'paperupdate'])->name('kullanici.PaperUpdate');

});
//Veri Yönetimi
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:superadmin|admin']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
//Superadmin Admin Yönetimi
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    // Admin listeleme, ekleme ve silme işlemleri için resource controller rotaları
    Route::get('/admins', [AdminController::class, 'superadminindex'])->name('superadmin.admins.index');
    Route::post('/admins', [AdminController::class, 'store'])->name('superadmin.admins.store');
    Route::delete('/admins/{user}', [AdminController::class, 'destroy'])->name('superadmin.admins.destroy');
});

//register
Route::middleware('auth')->get('/etkinlik-kaydi', [RegistrationController::class, 'create'])->name('registration.create');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/etkinlik-kaydi', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/register/summary', [RegistrationController::class, 'summary'])->name('registration.summary');
