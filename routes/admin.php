<?php

Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin'], function() {

    Route::get('/', ['uses' => 'PagesController@index', 'as' => 'admin.index']);

    Route::get('/articles', ['uses' => 'BlogController@index', 'as' => 'admin.articles']);
    Route::get('/articles/delete', ['uses' => 'BlogController@delete_all', 'as' => 'admin.blog.delete_all']);

    Route::get('/comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'admin.comments.edit']);
    Route::post('/comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'admin.comments.destroy']);


    Route::get('/articles/new', ['uses' => 'PagesController@create', 'as' => 'admin.articles.new']);
    Route::post('/articles/new', 'PagesController@store');

    Route::get('/articles/{id}', ['uses' => 'BlogController@destroy', 'as' => 'admin.articles.destroy']);
    Route::get('/articles/{id}/edit', ['uses' => 'PagesController@edit', 'as' => 'admin.articles.edit']);
    Route::post('/articles/{id}/edit', 'PagesController@update');

    Route::get('/settings', ['uses' => 'PagesController@settings', 'as' => 'admin.settings']);
    Route::post('/settings', 'PagesController@create_settings');
});
