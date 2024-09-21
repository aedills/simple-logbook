
<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\admin\Aktifitas;
use App\Http\Controllers\Aktifitas\Aktifitas as AktifitasAktifitas;
use App\Http\Controllers\DataUser\Magang;
use App\Http\Controllers\DataUser\Pkl;
use App\Http\Controllers\DataUser\Staf;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin::class, 'index'])->name('dashboard');


    // aktifitas
    Route::prefix('aktifitas')->name('aktifitas.')->group(function () {
        Route::get('/', [AktifitasAktifitas::class, 'index'])->name('index');
    });

    Route::prefix('datauser')->name('datauser.')->group(function () {
        // Staf
        Route::prefix('staf')->name('staf.')->group(function () {
            Route::get('/staf', [Staf::class, 'index'])->name('index');
            Route::post('/store', [Staf::class, 'store'])->name('store');
            Route::post('/update', [Staf::class, 'update'])->name('update');
            Route::post('/delete', [Staf::class, 'delete'])->name('delete');
        });

        // Staf
        Route::prefix('magang')->name('magang.')->group(function () {
            Route::get('/staf', [Magang::class, 'index'])->name('index');
            Route::post('/store', [Magang::class, 'store'])->name('store');
            Route::post('/update', [Magang::class, 'update'])->name('update');
            Route::post('/delete', [Magang::class, 'delete'])->name('update');
        });

        // Staf
        Route::prefix('pkl')->name('pkl.')->group(function () {
            Route::get('/staf', [Pkl::class, 'index'])->name('index');
            Route::post('/store', [Pkl::class, 'store'])->name('store');
            Route::post('/update', [Pkl::class, 'update'])->name('update');
            Route::post('/delete', [Pkl::class, 'delete'])->name('update');
        });
    });
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [User::class, 'login'])->name('loginuser');

    Route::get('/changepass', [User::class, 'changepass'])->name('changepass');
});
