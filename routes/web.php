<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DokumenKinerjaController;
use App\Http\Controllers\Dashboard\KinerjaController;
use App\Http\Controllers\Dashboard\PejabatAtasanController;
use App\Http\Controllers\Dashboard\PelaksanaanAnggaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //* main
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('testing', [DashboardController::class, 'testView'])->name('test');

    //* admin
    // ? admin
    Route::resource('daftar-admin', AdminController::class)
            ->except(['edit', 'update'])
            ->parameters(['daftar-admin' => 'user'])
            ->names([
                'index'         => 'daftar-admin.index',
                'create'        => 'daftar-admin.create',
                'store'         => 'daftar-admin.store',
                'show'          => 'daftar-admin.show',
                'edit'          => 'daftar-admin.edit',
                'update'        => 'daftar-admin.update',
                'destroy'       => 'daftar-admin.destroy',
            ]);
    // ? pejabat atasan
    Route::resource('pejabat-atasan', PejabatAtasanController::class)
            ->except(['edit', 'update'])
            ->parameters(['pejabat-atasan' => 'user'])
            ->names([
                'index'         => 'pejabat-atasan.index',
                'create'        => 'pejabat-atasan.create',
                'store'         => 'pejabat-atasan.store',
                'show'          => 'pejabat-atasan.show',
                'edit'          => 'pejabat-atasan.edit',
                'update'        => 'pejabat-atasan.update',
                'destroy'       => 'pejabat-atasan.destroy',
            ]);
    // ? dokumen kinerja
    Route::get('dokument-kinerja/search', [DokumenKinerjaController::class, 'search'])->name('dokument-kinerja.search');
    Route::resource('dokument-kinerja', DokumenKinerjaController::class)
            ->except([])
            ->parameters(['dokument-kinerja'    => 'dokumentKinerja'])
            ->names([
                'index'         => 'dokument-kinerja.index',
                'create'        => 'dokument-kinerja.create',
                'store'         => 'dokument-kinerja.store',
                'show'          => 'dokument-kinerja.show',
                'edit'          => 'dokument-kinerja.edit',
                'update'        => 'dokument-kinerja.update',
                'destroy'       => 'dokument-kinerja.destroy',
            ]);
    Route::get('dokumen-kinerja/{dokumentKinerja}/kinerja', [DokumenKinerjaController::class, 'kinerja'])
            ->name('dokument-kinerja-kinerja.index');
    
    // ? kinerja 
    Route::resource('kinerja', KinerjaController::class)
            ->except([])
            ->parameters([])
            ->names([
                'index'         => 'kinerja.index',
                'create'        => 'kinerja.create',
                'store'         => 'kinerja.store',
                'show'          => 'kinerja.show',
                'edit'          => 'kinerja.edit',
                'update'        => 'kinerja.update',
                'destroy'       => 'kinerja.destroy',
            ]);
    // ? kinerja & pelaksanaan anggaran
    Route::resource('pelaksanaan-anggaran', PelaksanaanAnggaranController::class)
            ->except([])
            ->parameters([])
            ->names([
                'index'         => 'pelaksanaan-anggaran.index',
                'create'        => 'pelaksanaan-anggaran.create',
                'store'         => 'pelaksanaan-anggaran.store',
                'show'          => 'pelaksanaan-anggaran.show',
                'edit'          => 'pelaksanaan-anggaran.edit',
                'update'        => 'pelaksanaan-anggaran.update',
                'destroy'       => 'pelaksanaan-anggaran.destroy',
            ]);


    //* pimpinan


    //* pegawai
});




require __DIR__.'/auth.php';
