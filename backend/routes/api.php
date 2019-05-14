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


Route::group([], function ($router) {;
    Route::post('signup', 'AuthController@signUp');
    Route::post('signin', 'AuthController@signIn');
});

Route::group([ 'middleware' => 'api', 'prefix' => 'shops'], function () {
    Route::post('', 'ShopController@getShops');
    Route::post('like', 'ShopController@likeShop');
});