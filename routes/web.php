<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\admin\Aktifitas;
use App\Http\Controllers\Aktifitas\Aktifitas as AktifitasAktifitas;
use App\Http\Controllers\DataUser\Magang;
use App\Http\Controllers\DataUser\Pkl;
use App\Http\Controllers\DataUser\Staf;
use App\Http\Controllers\User;
use App\Http\Controllers\User\AktifitasUser\History;
use App\Http\Controllers\User\AktifitasUser\Upload;
use App\Http\Controllers\User\Changepass;
use App\Http\Controllers\User\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin::class, 'index'])->name('dashboard');
    Route::get('/profile', [Admin::class, 'profile'])->name('profile');

    // aktifitas
    Route::prefix('aktifitas')->name('aktifitas.')->group(function () {
        Route::get('/', [AktifitasAktifitas::class, 'index'])->name('index');
    });

    Route::prefix('datauser')->name('datauser.')->group(function () {
        // Staf
        Route::prefix('staf')->name('staf.')->group(function () {
            Route::get('/', [Staf::class, 'index'])->name('index');
            Route::post('/store', [Staf::class, 'store'])->name('store');
            Route::post('/update', [Staf::class, 'update'])->name('update');
            Route::post('/delete', [Staf::class, 'delete'])->name('delete');
        });

        // Magang
        Route::prefix('magang')->name('magang.')->group(function () {
            Route::get('/', [Magang::class, 'index'])->name('index');
            Route::post('/store', [Magang::class, 'store'])->name('store');
            Route::post('/update', [Magang::class, 'update'])->name('update');
            Route::post('/delete', [Magang::class, 'delete'])->name('delete');
        });

        // Staf
        Route::prefix('pkl')->name('pkl.')->group(function () {
            Route::get('/', [Pkl::class, 'index'])->name('index');
            Route::post('/store', [Pkl::class, 'store'])->name('store');
            Route::post('/update', [Pkl::class, 'update'])->name('update');
            Route::post('/delete', [Pkl::class, 'delete'])->name('delete');
        });
    });
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [User::class, 'index'])->name('dashboarduser');
    Route::get('/login', [Login::class, 'index'])->name('loginuser');
    Route::get('/changepass', [Changepass::class, 'index'])->name('changepass');

    Route::prefix('aktifitasuser')->name('aktifitasuser.')->group(function () {
        Route::prefix('upload')->name('upload.')->group(function () {
            Route::get('/', [Upload::class, 'index'])->name('index');
            Route::post('/store', [Upload::class, 'store'])->name('store');
        });

        Route::get('/history', [History::class, 'index'])->name('history');
    });
});
