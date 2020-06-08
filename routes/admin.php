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
        Route::get('/', 'RolesController@index')->name('roles.index');
        Route::post('/', 'RolesController@store')->name('roles.store');
        Route::get('/{role}/edit', 'RolesController@edit')->name('roles.edit');
        Route::put('/{role}/update', 'RolesController@update')->name('roles.update');
        Route::delete('/{role}/destroy', 'RolesController@destroy')->name('roles.destroy');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionsController@index')->name('permissions.index');
        Route::post('/', 'PermissionsController@store')->name('permissions.store');
        Route::get('/{permission}/edit', 'PermissionsController@edit')->name('permissions.edit');
        Route::put('/{permission}/update', 'PermissionsController@update')->name('permissions.update');
        Route::delete('/{permission}/destroy', 'PermissionsController@destroy')->name('permissions.destroy');
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', 'MenusController@index')->name('menus.index');
        Route::post('/', 'MenusController@store')->name('menus.store');
        Route::get('/{menu}/edit', 'MenusController@edit')->name('menus.edit');
        Route::put('/{menu}', 'MenusController@update')->name('menus.update');
        Route::delete('/{menu}', 'MenusController@destroy')->name('menus.destroy');
    });

    Route::group(['prefix' => 'logs'], function () {
        Route::get('/', 'LogsController@index')->name('logs.index');
        Route::post('/', 'LogsController@store')->name('logs.store');
        Route::delete('/{log}', 'LogsController@destroy')->name('logs.destroy');
    });

});
