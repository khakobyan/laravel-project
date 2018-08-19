<?php

Route::group(['middleware' => ['before' => 'auth:api']], function () {
    Route::group(['prefix' => 'products'], function () {
        /* products resource start */
        Route::get('/', 'ProductsController@index');
        /* products resource end */
    });
    
    // Route::group(['prefix' => 'post-comments'], function () {
    //     /* post comments resource start */
    //     Route::post('/', 'PostCommentsController@store');
    //     Route::put('{id}', 'PostCommentsController@update');
    //     Route::delete('{id}', 'PostCommentsController@destroy');
    //     /* post comments resource end */
    // });
});
