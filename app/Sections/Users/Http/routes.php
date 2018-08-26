<?php

Route::group(['middleware' => ['before' => 'auth:api']], function () {
    Route::group(['prefix' => 'users'], function () {
        /* posts resource start */
        Route::get('/', 'UsersController@index');
        // Route::delete('delete', 'UserController@destroy');
        /* posts resource end */
        // Route::post('close', 'UserController@closeUser');
        Route::post('reactions', 'UsersController@addReaction');
        Route::post('friends', 'UsersController@addFriend');
        Route::post('friend-groups', 'UsersController@addFriendToGroup');
    });
});
