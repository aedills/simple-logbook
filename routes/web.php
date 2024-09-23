<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Aktifitas\Aktifitas;
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
    return redirect('/user');
});

// Auth
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/', function () {
        return redirect('/auth/login');
    });

    // Admin Auth
    Route::get('login', [Admin::class, 'login'])->name('login');
    Route::post('doLogin', [Admin::class, 'doLogin'])->name('doLogin');
    Route::get('logout', [Admin::class, 'logout'])->name('logout');

    // User Auth
    Route::get('userLogin', [Login::class, 'index'])->name('userLogin');
    Route::post('doUserLogin', [Login::class, 'doLogin'])->name('doUserLogin');
    Route::get('userLogout', [User::class, 'logout'])->name('userLogout');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('is.admin')->group(function () {
    Route::get('/', [Admin::class, 'index'])->name('dashboard');
    Route::get('/profile', [Admin::class, 'profile'])->name('profile');

    // aktifitas
    Route::prefix('aktifitas')->name('aktifitas.')->group(function () {
        Route::get('/', [Aktifitas::class, 'index'])->name('index');
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
Route::prefix('user')->name('user.')->middleware('is.user')->group(function () {
    Route::get('/', [User::class, 'index'])->name('dashboarduser');
    Route::get('/changepass', [Changepass::class, 'index'])->name('changepass');

    Route::prefix('aktifitasuser')->name('aktifitasuser.')->group(function () {
        Route::prefix('upload')->name('upload.')->group(function () {
            Route::get('/', [Upload::class, 'index'])->name('index');
            Route::post('/store', [Upload::class, 'store'])->name('store');
        });

        Route::get('/history', [History::class, 'index'])->name('history');
    });
});
