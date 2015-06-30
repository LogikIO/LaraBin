<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

});

Route::group(['middleware' => 'guest'], function () {

    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegistrationController@index']);
    Route::post('register', ['uses' => 'Auth\RegistrationController@create']);
    Route::get('register/confirm/{token}', ['as' => 'confirm', 'uses' => 'Auth\RegistrationController@confirm']);
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@login']);
    Route::post('login', ['uses' => 'Auth\AuthController@loginPost']);

});