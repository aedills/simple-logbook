<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin::class, 'index'])->name('dashboard');
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [User::class, 'login'])->name('loginuser');
});
