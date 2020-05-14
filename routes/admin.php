<?php

Auth::routes();

Route::namespace('Admin')->middleware(['auth'])->group( function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('index.index');

});
