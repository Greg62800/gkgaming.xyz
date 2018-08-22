<?php

Route::prefix('/auth')->group(function() {

    Route::get('/logout', ['uses' => 'UsersController@logout', 'as' => 'users.logout']);


    Route::get('/register', ['uses' => 'UsersController@register', 'as' => 'users.register']);
    Route::post('/register', 'UsersController@store');

    Route::get('/login', ['uses' => 'UsersController@login', 'as' => 'users.login']);
    Route::post('/login', 'UsersController@login_in');
});

Route::prefix('/profil')->group(function() {

    Route::get('/', ['uses' => 'UsersController@index', 'as'=> 'profil.view']);

    Route::get('/avatar', ['uses' => 'UsersController@avatar_delete', 'as' => 'users.del_avatar']);

    Route::get('/edit', ['uses' => 'UsersController@edit', 'as' => 'users.edit']);
    Route::post('/edit', 'UsersController@update');
});
