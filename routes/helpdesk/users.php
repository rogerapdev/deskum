<?php

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
 */
Route::name('users.')->prefix('users')->group(function () {
    Route::get('/')->name('index')->uses('UserController@index');
    Route::get('create')->name('create')->uses('UserController@create');
    Route::post('create')->name('store')->uses('UserController@store');
    Route::get('{id}')->name('edit')->uses('UserController@edit');
    Route::put('{id}')->name('update')->uses('UserController@update');
    Route::delete('{id}')->name('delete')->uses('UserController@delete');

    Route::name('reports.')->prefix('reports')->group(function () {
        Route::get('listing')->name('listing')->uses('UserController@listing');
        Route::post('listing')->name('listing.print')->uses('UserController@listing');
    });
});
