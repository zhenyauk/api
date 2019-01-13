<?php

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');


/* Auth Group */
Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    //user
    Route::get('user', 'API\UserController@user');
    Route::post('logout', 'API\AuthController@logout');


    //wallet
    Route::get('wallet', 'API\WalletController@wallet');





});




Route::middleware('jwt.refresh')->get('/token/refresh', 'API\AuthController@refresh');