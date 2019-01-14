<?php

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');


/* Auth Group */
Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    //user
    Route::get('user', 'API\UserController@user');
    Route::post('user/password', 'API\UserController@changePassword');
    Route::post('user/change', 'API\UserController@changeUser');

    Route::post('logout', 'API\AuthController@logout');


    //wallet
    Route::get('wallet', 'API\WalletController@wallet');
    Route::post('wallet/edit', 'API\WalletController@edit_wallet');
    Route::post('wallet/plus', 'API\WalletController@plus');
    Route::post('wallet/minus', 'API\WalletController@minus');





});




Route::middleware('jwt.refresh')->get('/token/refresh', 'API\AuthController@refresh');