<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

    Route::post('login', 'AuthController@authenticate')->name('auth.authenticate');
    Route::post('register', 'AuthController@createUser')->name('auth.createUser');

    Route::group(['middleware' => 'auth:sanctum'], function () {

    });

});