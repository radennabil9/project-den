<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserULPController;
use App\Http\Controllers\UserUP3Controller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::resource('userulps', UserULPController::class);
Route::resource('admins', AdminController::class);
Route::resource('tims', TimController::class);
Route::get('/transaksis/filter', [TransaksiController::class, 'filter'])->name('transaksis.filter');
Route::get('/transaksis/export-excel', [TransaksiController::class, 'exportExcel'])->name('transaksis.export');
Route::resource('transaksis', TransaksiController::class);



Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


// Ganti semua ini:
Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');
Route::get('/dashboard/ulp', [DashboardController::class, 'index'])->name('dashboard.ulp');


Route::middleware(['checkLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/transaksis', TransaksiController::class);
});




// Route::get('/userulp/dashboard', function(){ return view('userulp.dashboard'); })->name('userulp.dashboard');
