<?php

Route::group(['middleware' => ['before' => 'auth:api']], function () {
    Route::group(['prefix' => 'posts'], function () {
        /* posts resource start */
        Route::get('/', 'PostsController@index');
        Route::post('/', 'PostsController@store');
        Route::get('{id}', 'PostsController@show');
        Route::put('{id}', 'PostsController@update');
        Route::delete('{id}', 'PostsController@destroy');
        /* posts resource end */
    });
});