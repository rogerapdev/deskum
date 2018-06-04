<?php

/*
|--------------------------------------------------------------------------
| Teams Routes
|--------------------------------------------------------------------------
 */
Route::name('teams.')->prefix('teams')->group(function () {
    Route::get('/')->name('index')->uses('TeamController@index');
    Route::get('create')->name('create')->uses('TeamController@create');
    Route::post('create')->name('store')->uses('TeamController@store');
    Route::get('{id}')->name('edit')->uses('TeamController@edit');
    Route::put('{id}')->name('update')->uses('TeamController@update');
    Route::delete('{id}')->name('delete')->uses('TeamController@delete');

    Route::name('reports.')->prefix('reports')->group(function () {
        Route::get('listing')->name('listing')->uses('TeamController@listing');
        Route::post('listing')->name('listing.print')->uses('TeamController@listing');
    });
});
