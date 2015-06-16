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

Route::resource('account', 'AccountController');
Route::get('account/use/{id}', 'AccountController@use_one');
Route::get('account/cancel/{id}', 'AccountController@cancel');

Route::group(['prefix' => 'gui'], function(){
	Route::get('/', 'GuiController@index');
	Route::get('/create', 'GuiController@create');
});
