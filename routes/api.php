<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Only internal network IP address
Route::group(['middleware' => ['ip:127.0.0.1,192.168.*', 'checktoken']], function () {

    // Your ip restricted routes goes here!

    Route::name('token.')->prefix('token')->group(function () {
        Route::get('new')->name('new')->uses('Api\TokenController@newToken');

    });

    Route::name('tickets.')->prefix('tickets')->group(function () {
        Route::get('/')->name('index')->uses('Api\TicketController@index');
    });

});
