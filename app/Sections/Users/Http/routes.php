<?php

Route::group(['middleware' => ['before' => 'auth:api']], function () {
    Route::group(['prefix' => 'users'], function () {
        /* posts resource start */
        Route::get('/', 'UsersController@index');
        /* posts resource end */
        Route::post('reaction', 'UsersController@addReaction');
    });
});
