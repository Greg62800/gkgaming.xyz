<?php

Route::prefix('/notifications')->group(function() {
    Route::get('/', ['uses' => 'NotificationsController@index', 'as' => 'notifications.index']);
    Route::get('/{id}', ['uses' => 'NotificationsController@read', 'as' => 'notifications.read']);
    Route::get('/view/{article_id}/{notif_id}', ['uses' => 'NotificationsController@show', 'as' => 'notifications.show']);
    Route::get('/go/{article_id}/{id_notif}', ['uses' => 'NotificationsController@show_article', 'as' => 'notifications.show_article']);
    Route::get('/unread/{id}', ['uses' => 'NotificationsController@unRead', 'as' => 'notifications.read_at']);
    Route::get('/isread/{id}', ['uses' => 'NotificationsController@isRead', 'as' => 'notifications.is_read']);
    Route::get('/read/all', ['uses' => 'NotificationsController@readAll', 'as' => 'notifications.all_read']);
});