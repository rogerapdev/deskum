<?php

/*
|--------------------------------------------------------------------------
| Tickets Routes
|--------------------------------------------------------------------------
 */
Route::name('tickets.')->prefix('tickets')->group(function () {
    Route::get('/')->name('index')->uses('TicketController@index');
    Route::get('create')->name('create')->uses('TicketController@create');
    Route::post('create')->name('store')->uses('TicketController@store');
    Route::get('{id}')->name('edit')->uses('TicketController@edit');
    Route::put('{id}')->name('update')->uses('TicketController@update');
    Route::delete('{id}')->name('delete')->uses('TicketController@delete');

    Route::get('{id}/read')->name('read')->uses('TicketController@show');

    Route::post('{id}/comment')->name('comment')->uses('TicketController@comment');
    Route::post('{id}/change-status')->name('change-status')->uses('TicketController@changeStatus');
    Route::post('{id}/change-priority')->name('change-priority')->uses('TicketController@changePriority');

    Route::name('reports.')->prefix('reports')->group(function () {
        Route::get('listing')->name('listing')->uses('TicketController@listing');
        Route::post('listing')->name('listing.print')->uses('TicketController@listing');
    });
});
