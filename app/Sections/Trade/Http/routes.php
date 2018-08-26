<?php

Route::group(['middleware' => ['before' => 'auth:api']], function () {
    Route::group(['prefix' => 'products'], function () {
        /* products resource start */
        Route::get('/', 'ProductsController@index');
        Route::post('/', 'ProductsController@store');
        Route::get('{id}', 'ProductsController@show');
        Route::put('{id}', 'ProductsController@update');
        Route::delete('{id}', 'ProductsController@destroy');
        /* products resource end */
    });
    
    Route::group(['prefix' => 'product-comments'], function () {
        /* product comments resource start */
        Route::post('/', 'ProductCommentsController@store');
        Route::put('{id}', 'ProductCommentsController@update');
        Route::delete('{id}', 'ProductCommentsController@destroy');
        /* product comments resource end */
    });
});
