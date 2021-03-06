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
Route::get('account/fastuse/{social_media}', 'AccountController@fastuse');
Route::resource('account', 'AccountController');

Route::group(['prefix' => 'gui'], function(){
	Route::get('/', 'GuiController@index');
	Route::get('/create', 'GuiController@create');
	Route::get('/check', 'GuiController@check');
});

Route::group(['prefix' => 'auth_twitter'], function(){
	Route::get('/connect', 'TwitterAuthController@connect');
	Route::get('/mirror', 'TwitterAuthController@mirror');
});

Route::group(['prefix' => 'auth_facebook'], function(){
	Route::get('/connect', 'FacebookAuthController@connect');
	Route::get('/mirror', 'FacebookAuthController@mirror');
});

Route::group(['prefix' => 'auth_instagram'], function(){
	Route::get('/connect', 'InstagramAuthController@connect');
	Route::get('/mirror', 'InstagramAuthController@mirror');
});

Route::group(['prefix' => 'auth_googleplus'], function(){
	Route::get('/connect', 'GooglePlusAuthController@connect');
	Route::get('/mirror', 'GooglePlusAuthController@mirror');
});

Route::group(['prefix' => 'auth_linkedin'], function(){
	Route::get('/connect', 'LinkedInAuthController@connect');
	Route::get('/mirror', 'LinkedInAuthController@mirror');
});

Route::get('/oauth2callback', function(){redirect()->route('auth_googleplus/mirror');});

