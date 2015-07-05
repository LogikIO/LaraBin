<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Socialite
Route::get('auth/github', ['as' => 'social.github', 'uses' => 'Auth\Socialite\GithubController@redirectToProvider']);
Route::get('auth/github/callback', ['as' => 'social.github.callback', 'uses' => 'Auth\Socialite\GithubController@handleProviderCallback']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    Route::get('settings', ['as' => 'settings', 'uses' => 'Auth\SettingsController@index']);
    Route::post('settings', ['uses' => 'Auth\SettingsController@update']);
    Route::get('delete', ['as' => 'delete', 'uses' => 'Auth\SettingsController@delete']);
    Route::post('delete', ['uses' => 'Auth\SettingsController@deletePost']);


    Route::get('bins/create', ['as' => 'bins.create', 'uses' => 'Bins\BinController@create']);
    Route::post('bins/create', ['uses' => 'Bins\BinController@createPost']);
    Route::post('bins/ajax', ['as' => 'bins.ajax', 'uses' => 'Bins\BinController@ajax']);
    Route::get('bins/my', ['as' => 'bins.my', 'uses' => 'Bins\BinController@my']);


    Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('users', ['as' => 'users', 'uses' => 'Admin\UserController@index']);
        Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'Admin\UserController@edit']);
        Route::post('users/{id}/edit', ['uses' => 'Admin\UserController@editPost']);
        Route::post('users/activate', ['as' => 'users.activate', 'uses' => 'Admin\UserController@activate']);
    });

});

Route::group(['middleware' => 'guest'], function () {

    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegistrationController@index']);
    Route::post('register', ['uses' => 'Auth\RegistrationController@create']);
    Route::get('register/confirm/{token}', ['as' => 'confirm', 'uses' => 'Auth\RegistrationController@confirm']);
    Route::get('register/resend', ['as' => 'resend.email', 'uses' => 'Auth\RegistrationController@resend']);
    Route::post('register/resend', ['uses' => 'Auth\RegistrationController@resendPost']);
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@login']);
    Route::post('login', ['uses' => 'Auth\AuthController@loginPost']);
    Route::get('login/reset', ['as' => 'reset', 'uses' => 'Auth\AuthController@reset']);
    Route::post('login/reset', ['uses' => 'Auth\AuthController@resetPost']);
    Route::get('login/reset/confirm/{token}', ['as' => 'reset.confirm', 'uses' => 'Auth\AuthController@confirm']);
    Route::post('login/reset/confirm/{token}', ['uses' => 'Auth\AuthController@confirmPost']);

});

Route::get('@{username}', ['as' => 'user', 'uses' => 'UserController@show']);

Route::get('bins/recent/{version?}', ['as' => 'bins.recent', 'uses' => 'Bins\BinController@allRecent']);
Route::get('bins/{version?}', ['as' => 'bins.all', 'uses' => 'Bins\BinController@all']);
Route::get('{bin}', ['as' => 'bin.code', 'uses' => 'Bins\BinController@show', 'middleware' => 'bin.view']);
Route::get('{bin}/comments', ['as' => 'bin.comments', 'uses' => 'Bins\CommentController@comments', 'middleware' => 'bin.view']);
Route::post('{bin}/comments', ['uses' => 'Bins\CommentController@newComment', 'middleware' => ['auth', 'bin.view']]);
Route::get('{bin}/comments/{comment}/edit', ['as' => 'bin.comments.edit', 'uses' => 'Bins\CommentController@edit', 'middleware' => ['auth', 'bin.view', 'comment.manage']]);
Route::post('{bin}/comments/{comment}/edit', ['uses' => 'Bins\CommentController@editPost', 'middleware' => ['auth', 'bin.view', 'comment.manage']]);
Route::get('{bin}/comments/{comment}/delete', ['as' => 'bin.comments.delete', 'uses' => 'Bins\CommentController@delete', 'middleware' => ['auth', 'bin.view', 'comment.manage']]);
Route::post('{bin}/comments/{comment}/delete', ['uses' => 'Bins\CommentController@deletePost', 'middleware' => ['auth', 'bin.view', 'comment.manage']]);
Route::get('{bin}/edit', ['as' => 'bin.edit', 'uses' => 'Bins\BinController@edit', 'middleware' => ['auth', 'bin.manage']]);
Route::post('{bin}/edit', ['uses' => 'Bins\BinController@editPost', 'middleware' => ['auth', 'bin.manage']]);
Route::get('{bin}/delete', ['as' => 'bin.delete', 'uses' => 'Bins\BinController@delete', 'middleware' => ['auth', 'bin.manage']]);
Route::post('{bin}/delete', ['uses' => 'Bins\BinController@deletePost', 'middleware' => ['auth', 'bin.manage']]);
Route::get('{bin}/{snippet}', ['as' => 'bin.snippet', 'uses' => 'Bins\BinController@showSnippet', 'middleware' => 'bin.view']);