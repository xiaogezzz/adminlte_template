<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::namespace('Admin')->middleware(['auth', 'check.permission'])->group( function () {

    Route::get('/', function () {
        return view('admin.welcome');
    })->name('index');

    /*
    |--------------------------------------------------------------------------
    | 系统管理
    |--------------------------------------------------------------------------
    */
    //管理员
    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', 'AdminsController@index')->name('admins.index');
        Route::post('/', 'AdminsController@store')->name('admins.store');
        Route::get('/{admin}/edit', 'AdminsController@edit')->name('admins.edit');
        Route::put('/{admin}/update', 'AdminsController@update')->name('admins.update');
        Route::delete('/{admin}', 'AdminsController@destroy')->name('admins.destroy');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'AdminsController@index')->name('roles.index');
        Route::post('/', 'AdminsController@store')->name('roles.store');
        Route::get('/{admin}/edit', 'AdminsController@edit')->name('roles.edit');
        Route::post('/update', 'AdminsController@update')->name('roles.update');
        Route::get('/{admin}/destroy', 'AdminsController@destroy')->name('roles.destroy');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'AdminsController@index')->name('permissions.index');
        Route::post('/', 'AdminsController@store')->name('permissions.store');
        Route::get('/{admin}/edit', 'AdminsController@edit')->name('permissions.edit');
        Route::post('/update', 'AdminsController@update')->name('permissions.update');
        Route::get('/{admin}/destroy', 'AdminsController@destroy')->name('permissions.destroy');
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', 'AdminsController@index')->name('menus.index');
        Route::post('/', 'AdminsController@store')->name('menus.store');
        Route::get('/{admin}/edit', 'AdminsController@edit')->name('menus.edit');
        Route::post('/update', 'AdminsController@update')->name('menus.update');
        Route::get('/{admin}/destroy', 'AdminsController@destroy')->name('menus.destroy');
    });

    Route::group(['prefix' => 'logs'], function () {
        Route::get('/', 'AdminsController@index')->name('logs.index');
        Route::post('/', 'AdminsController@store')->name('logs.store');
        Route::get('/{admin}/edit', 'AdminsController@edit')->name('logs.edit');
        Route::post('/update', 'AdminsController@update')->name('logs.update');
        Route::get('/{admin}/destroy', 'AdminsController@destroy')->name('logs.destroy');
    });

});
