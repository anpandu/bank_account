<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('gui');
});

Route::get('account/use/{id}', 'AccountController@use_one');
Route::get('account/cancel/{id}', 'AccountController@cancel');
Route::get('account/fastuse', 'AccountController@fastuse');
Route::resource('account', 'AccountController');

Route::group(['prefix' => 'gui'], function(){
	Route::get('/', 'GuiController@index');
	Route::get('/create', 'GuiController@create');
});

Route::group(['prefix' => 'auth_twitter'], function(){
	Route::get('/connect', 'TwitterAuthController@connect');
	Route::get('/mirror', 'TwitterAuthController@mirror');
});
