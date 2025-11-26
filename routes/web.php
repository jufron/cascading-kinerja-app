<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PejabatAtasanController;
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

    //* pimpinan


    //* pegawai
});




require __DIR__.'/auth.php';
