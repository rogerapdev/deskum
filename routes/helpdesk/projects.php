<?php

/*
|--------------------------------------------------------------------------
| Projects Routes
|--------------------------------------------------------------------------
 */
Route::name('projects.')->prefix('projects')->group(function () {
    Route::get('/')->name('index')->uses('ProjectController@index');
    Route::get('create')->name('create')->uses('ProjectController@create');
    Route::post('create')->name('store')->uses('ProjectController@store');
    Route::get('{id}')->name('edit')->uses('ProjectController@edit');
    Route::put('{id}')->name('update')->uses('ProjectController@update');
    Route::delete('{id}')->name('delete')->uses('ProjectController@delete');

    Route::name('reports.')->prefix('reports')->group(function () {
        Route::get('listing')->name('listing')->uses('ProjectController@listing');
        Route::post('listing')->name('listing.print')->uses('ProjectController@listing');
    });
});
