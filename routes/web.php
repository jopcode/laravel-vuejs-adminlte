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

/**
 * ADMIN
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
	Route::get('/', 'AppController@index')->name('admin.app');
});

/**
 * FRONT
 */
Route::group(['namespace' => 'Front'], function(){
	Route::get('/', 'HomeController@index')->name('front.home');
});
