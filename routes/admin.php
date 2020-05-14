<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::namespace('Admin')->middleware(['auth'])->group( function () {

    Route::get('/', function () {
        return view('admin.welcome');
    })->name('index.index');

});
