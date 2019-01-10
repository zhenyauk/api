<?php

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    Route::get('user', 'API\AuthController@user');
    Route::post('logout', 'API\AuthController@logout');
});

Route::middleware('jwt.refresh')->get('/token/refresh', 'API\AuthController@refresh');