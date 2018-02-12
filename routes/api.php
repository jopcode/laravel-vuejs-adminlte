<?php

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

/**
 * ADMIN
 */
Route::group(['namespace' => 'Admin\Api', 'prefix' => 'admin/api', 'as' => 'admin.api.', 'middleware' => 'auth:api'], function(){
    Route::get('auth/user', 'AuthController@show')->name('auth.user');
});

/**
 * FRONT
 */
Route::group(['namespace' => 'Front'], function(){

});
