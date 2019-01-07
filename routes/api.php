<?php

use Illuminate\Http\Request;

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {



    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
