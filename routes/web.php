<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home.index']);



Route::prefix('/blog')->group(function() {
    Route::post('/{slug}/add_comment', ['uses' => 'CommentsController@add_comment', 'as' => 'comment.add']);
    Route::get('/{slug}/delete_comment/{id}', ['uses' => 'CommentsController@delete_comment', 'as' => 'blog.delete_comment']);
    Route::get('/', ['uses' => 'BlogController@index', 'as' => 'blog.index']);

    Route::get('/category/{name}', ['uses' => 'BlogController@category', 'as' => 'category.name']);
    Route::post('/cats', ['uses' => 'BlogController@cats', 'as' => 'blog.categories']);
    Route::get('/category/{name}/{article_name}', ['uses' => 'BlogController@category_post', 'as' => 'blog.category_post']);

    Route::get('/{slug}', ['uses' => 'BlogController@show', 'as' => 'blog.show']);
});