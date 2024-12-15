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

//Admin Univ
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/statistik', [AdminController::class, 'statistik'])->name('admin.statistik');
    Route::get('/admin/fakultas', [AdminController::class, 'listFakultas'])->name('admin.listFakultas');
    Route::get('/admin/prodi', [AdminController::class, 'listProdi'])->name('admin.listProdi');
    Route::get('/admin/dosen', [AdminController::class, 'listDosen'])->name('admin.listDosen');
    Route::get('/admin/admin-fakultas', [AdminController::class, 'listAdminFakultas'])->name('admin.listAdminFakultas');
    Route::get('/admin/admin-prodi', [AdminController::class, 'listAdminProdi'])->name('admin.listAdminProdi');
});

//Admin Fakultas
Route::middleware(['auth', 'role:fakultas'])->group(function () {
    Route::get('/fakultas/dashboard', [FakultasController::class, 'dashboard'])->name('fakultas.dashboard');
    Route::get('/fakultas/prodi', [FakultasController::class, 'listProdi'])->name('fakultas.listProdi');
    Route::get('/fakultas/dosen', [FakultasController::class, 'listDosen'])->name('fakultas.listDosen');
    Route::get('/fakultas/admin-prodi', [FakultasController::class, 'listAdminProdi'])->name('fakultas.listAdminProdi');
});

//Admin Prodi
Route::middleware(['auth', 'role:prodi'])->group(function () {
    Route::get('/prodi/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
    Route::get('/prodi/dosen', [FakultasController::class, 'listDosen'])->name('prodi.listDosen');
});

//Admin Dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
});

// CRUD
// ADD Dosen
Route::get('/tambah-dosen', [AdminController::class, 'tambahDosen'])->name('user.add');
Route::post('/tambah-dosen', [AdminController::class, 'store'])->name('user.store');
// EDIT Dosen
Route::get('/user/{id}/edit', [AdminController::class, 'editDosen'])->name('user.edit');
Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');
// DESTROY Dosen
Route::delete('/user/{id}', [AdminController::class, 'destroy'])->name('user.destroy');

// ADD Admin Fakultas 
Route::get('/tambah-admin-fakultas', [UserController::class, 'user.add']);
// Route::post('/tambah-admin-fakultas', [AdminController::class, 'store'])->name('user.store');
// EDIT Admin Fakultas
Route::get('/user2/{id}/edit2', [UserController::class, 'edit2'])->name('user2.edit2');
Route::put('/user2/{id}', [UserController::class, 'update2'])->name('user2.update2');
// DESTROY Admin Fakultas
Route::delete('/user2/{id}', [UserController::class, 'destroy2'])->name('user2.destroy2');

// ADD Admin Prodi
Route::get('/tambahAdminProdiUniv', [UserController::class, 'tambahAdminProdiUniv']);
Route::post('/adminProdiUniv', [UserController::class, 'store3'])->name('user3.store3');
// EDIT Admin Prodi 
Route::get('/user3/{id}/edit3', [UserController::class, 'edit3'])->name('user3.edit3');
Route::put('/user3/{id}', [UserController::class, 'update3'])->name('user3.update3');
// DESTROY Admin Prodi
Route::delete('/user3/{id}', [UserController::class, 'destroy3'])->name('user3.destroy3');


require __DIR__ . '/auth.php';
