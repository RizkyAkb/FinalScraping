<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\ScrapingController;


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
    Route::get('/scrape', [ScrapingController::class, 'scrapePublications'])->name('scrapeAll');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/api/publikasi-data', [PublikasiController::class, 'getPublicationData']);    
    Route::get('/admin/statistik', [AdminController::class, 'statistik'])->name('admin.statistik');
    Route::get('/admin/fakultas', [AdminController::class, 'listFakultas'])->name('admin.listFakultas');
    Route::get('/admin/prodi', [AdminController::class, 'listProdi'])->name('admin.listProdi');
    Route::get('/admin/dosen', [AdminController::class, 'listDosen'])->name('admin.listDosen');
    Route::get('/admin/admin-fakultas', [AdminController::class, 'listAdminFakultas'])->name('admin.listAdminFakultas');
    Route::get('/admin/admin-prodi', [AdminController::class, 'listAdminProdi'])->name('admin.listAdminProdi');

    //CRUD FAKULTAS
    // ADD Fakultas    
    Route::get('/fakultas', [FakultasController::class, 'create'])->name('fakultas.create');
    Route::post('/tambah-fakultas', [FakultasController::class, 'store'])->name('fakultas.store');
    // EDIT Fakultas
    Route::get('/fakultas/{id}/edit', [FakultasController::class, 'edit'])->name('fakultas.edit');
    Route::put('/fakultas/{id}', [FakultasController::class, 'update'])->name('fakultas.update');
    // DESTROY Fakultas
    Route::delete('/fakultas/{id}', [FakultasController::class, 'destroy'])->name('fakultas.destroy');

    //CRUD PRODI
    // ADD Prodi    
    Route::get('/prodi', [ProdiController::class, 'create'])->name('prodi.create');
    Route::post('/tambah-prodi', [ProdiController::class, 'store'])->name('prodi.store');
    // EDIT Prodi
    Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    // DESTROY Prodi
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

});

//Admin Fakultas
Route::middleware(['auth', 'role:fakultas'])->group(function () {
    Route::get('/scrape/fakultas/{id}', [ScrapingController::class, 'scrapePublicationsByFakultas'])->name('fakultas.scrape');
    
    Route::get('/fakultas/dashboard', [FakultasController::class, 'dashboard'])->name('fakultas.dashboard');
    Route::get('/fakultas/statistik', [FakultasController::class, 'statistik'])->name('fakultas.statistik');
    Route::get('/fakultas/prodi', [FakultasController::class, 'listProdi'])->name('fakultas.listProdi');
    Route::get('/fakultas/dosen', [FakultasController::class, 'listDosen'])->name('fakultas.listDosen');
    Route::get('/fakultas/admin-prodi', [FakultasController::class, 'listAdminProdi'])->name('fakultas.listAdminProdi');
});

//Admin Prodi
Route::middleware(['auth', 'role:prodi'])->group(function () {
    Route::get('/scrape/prodi/{id}', [ScrapingController::class, 'scrapePublicationsByProdi']);

    Route::get('/prodi/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
    Route::get('/prodi/dosen', [FakultasController::class, 'listDosen'])->name('prodi.listDosen');
});

//Admin Dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');

});

Route::middleware(['auth', 'role:admin,fakultas,prodi'])->group(function () {
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
    Route::get('/tambah-admin-fakultas', [AdminController::class, 'tambahAdmFakultas'])->name('admFakultas.add');
    Route::post('/tambah-admin-fakultas', [AdminController::class, 'storeAdmFakultas'])->name('admFakultas.store');
    // EDIT Admin Fakultas
    Route::get('/admin-fakultas/{id}/edit', [AdminController::class, 'editAdmFakultas'])->name('admFakultas.edit');
    Route::put('/admin-fakultas/{id}', [AdminController::class, 'updateAdmFakultas'])->name('admFakultas.update');
    // DESTROY Admin Fakultas
    Route::delete('/admin-fakultas/{id}', [AdminController::class, 'destroyAdmFakultas'])->name('admFakultas.destroy');

    // ADD Admin Prodi
    Route::get('/tambah-admin-prodi', [AdminController::class, 'tambahAdmProdi'])->name('admProdi.add');
    Route::post('/tambah-admin-prodi', [AdminController::class, 'storeAdmProdi'])->name('admProdi.store');
    // EDIT Admin Prodi 
    Route::get('/admin-prodi/{id}/edit', [AdminController::class, 'editAdmProdi'])->name('admProdi.edit');
    Route::put('/admin-prodi/{id}', [AdminController::class, 'updateAdmProdi'])->name('admProdi.update');
    // DESTROY Admin Prodi
    Route::delete('/admin-prodi/{id}', [AdminController::class, 'destroyAdmProdi'])->name('admProdi.destroy');
});

require __DIR__ . '/auth.php';
