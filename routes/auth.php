<?php

/**
 * FRONT
 */
Route::group(['namespace' => 'Front'], function(){
    // Authentication Routes
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('front.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('front.logout');

    // Registration Routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('front.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('front.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('front.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});