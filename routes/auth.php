<?php

// Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//Password reset routes
Route::get('password/reset')->name('password.email')->uses('Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email')->name('password.send')->uses('Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}')->name('password.token')->uses('Auth\ResetPasswordController@showResetForm');
Route::post('password/reset')->name('password.reset')->uses('Auth\ResetPasswordController@reset');
