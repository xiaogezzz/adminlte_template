<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::namespace('Admin')->middleware(['auth', 'check.permission'])->group( function () {

    Route::get('/', function () {
        return view('admin.welcome');
    })->name('index');

});
