<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DosenController;


Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/statistik', [AdminController::class, 'statistik'])->name('admin.statistik');
    Route::get('/admin/fakultas', [AdminController::class, 'listFakultas'])->name('admin.listFakultas');
    Route::get('/admin/prodi', [AdminController::class, 'listProdi'])->name('admin.listProdi');
    Route::get('/admin/dosen', [AdminController::class, 'listDosen'])->name('admin.listDosen');
    Route::get('/admin/admin-fakultas', [AdminController::class, 'listAdminFakultas'])->name('admin.listAdminFakultas');
    Route::get('/admin/admin-prodi', [AdminController::class, 'listAdminProdi'])->name('admin.listAdminProdi');
});

Route::middleware(['auth', 'role:fakultas'])->group(function(){
    Route::get('/fakultas/dashboard', [FakultasController::class, 'dashboard'])->name('fakultas.dashboard');
    Route::get('/fakultas/prodi', [FakultasController::class, 'listProdi'])->name('fakultas.listProdi');
    Route::get('/fakultas/dosen', [FakultasController::class, 'listDosen'])->name('fakultas.listDosen');    
    Route::get('/fakultas/admin-prodi', [FakultasController::class, 'listAdminProdi'])->name('fakultas.listAdminProdi');
});

Route::middleware(['auth', 'role:prodi'])->group(function(){
    Route::get('/prodi/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
    Route::get('/prodi/dosen', [FakultasController::class, 'listDosen'])->name('prodi.listDosen');    
});

Route::middleware(['auth', 'role:dosen'])->group(function(){
    Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');        
});

require __DIR__.'/auth.php';
