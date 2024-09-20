<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\admin\Aktifitas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin::class, 'index'])->name('dashboard');

    // aktifitas
    Route::prefix('aktifitas')->name('aktifitas.')->group(function(){
        Route::get('/', [Aktifitas::class,'index'])->name('index');
    });

});
