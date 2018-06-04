<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect('login');
    // return view('welcome');
});

include 'auth.php';

Route::group(['middleware' => 'auth'], function () {

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/')->name('index')->uses('DashboardController@index');
        Route::get('settings')->name('settings')->uses('DashboardController@settings');
        Route::get('calls')->name('calls')->uses('DashboardController@calls');
        Route::get('leads')->name('leads')->uses('DashboardController@leads');

    });

    Route::bind('id', function ($id) {
        return Hasher::decode($id);
    });

    $files = glob(__DIR__ . '/helpdesk/*.php');
    foreach ($files as $file) {
        require_once $file;
    }
});
