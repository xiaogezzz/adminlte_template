<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::namespace('Admin')->middleware(['auth', 'check.permission'])->group(function () {

    Route::get('/', 'IndexController@index')->name('index');

    /*
    |--------------------------------------------------------------------------
    | 系统管理模块
    |--------------------------------------------------------------------------
    */
    // 管理员
    Route::get('admins/', 'AdminsController@index')->name('admins.index');
    Route::post('admins/', 'AdminsController@store')->name('admins.store');
    Route::get('admins/{admin}/edit', 'AdminsController@edit')->name('admins.edit');
    Route::put('admins/{admin}/update', 'AdminsController@update')->name('admins.update');
    Route::delete('admins/{admin}', 'AdminsController@destroy')->name('admins.destroy');

    // 角色
    Route::get('roles/', 'RolesController@index')->name('roles.index');
    Route::post('roles/', 'RolesController@store')->name('roles.store');
    Route::get('roles/{role}/edit', 'RolesController@edit')->name('roles.edit');
    Route::put('roles/{role}/update', 'RolesController@update')->name('roles.update');
    Route::delete('roles/{role}/destroy', 'RolesController@destroy')->name('roles.destroy');

    // 权限
    Route::get('permissions/', 'PermissionsController@index')->name('permissions.index');
    Route::post('permissions/', 'PermissionsController@store')->name('permissions.store');
    Route::get('permissions/{permission}/edit', 'PermissionsController@edit')->name('permissions.edit');
    Route::put('permissions/{permission}/update', 'PermissionsController@update')->name('permissions.update');
    Route::delete('permissions/{permission}/destroy', 'PermissionsController@destroy')->name('permissions.destroy');

    // 菜单
    Route::get('menus/', 'MenusController@index')->name('menus.index');
    Route::post('menus/', 'MenusController@store')->name('menus.store');
    Route::get('menus/{menu}/edit', 'MenusController@edit')->name('menus.edit');
    Route::put('menus/{menu}', 'MenusController@update')->name('menus.update');
    Route::delete('menus/{menu}', 'MenusController@destroy')->name('menus.destroy');

    // 操作日志
    Route::get('logs/', 'LogsController@index')->name('logs.index');
    Route::post('logs/', 'LogsController@store')->name('logs.store');
    Route::delete('logs/{log}', 'LogsController@destroy')->name('logs.destroy');

});
