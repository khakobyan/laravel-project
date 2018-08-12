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
        Route::post('reaction', 'PostsController@addReaction');
    });
    
    Route::group(['prefix' => 'post-comments'], function () {
        /* post comments resource start */
        Route::post('/', 'PostCommentsController@store');
        Route::put('{id}', 'PostCommentsController@update');
        Route::delete('{id}', 'PostCommentsController@destroy');
        /* post comments resource end */
        Route::post('reaction', 'PostCommentsController@addReaction');
    });
});
