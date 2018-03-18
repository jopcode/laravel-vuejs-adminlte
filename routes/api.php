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
    Route::put('auth/user', 'AuthController@update')->name('auth.user.update');
    Route::post('auth/user/upload_profile_image', 'AuthController@uploadProfileImage')->name('auth.user.upload_profile_image');

    Route::get('roles', 'RoleController@index')->name('roles.index');
});

/**
 * FRONT
 */
Route::group(['namespace' => 'Front'], function(){

});
