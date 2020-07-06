<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function ($router) {

    Route::post('authorizations', 'AuthController@store');
    Route::delete('authorizations/current', 'AuthController@destroy');
    Route::put('authorizations/current', 'AuthController@update');
    Route::post('me', 'AuthController@me');

});
