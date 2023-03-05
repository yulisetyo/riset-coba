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

//~ Route::get('/', function () {
//~ return view('app');
//~ });
Route::get('/token', function () {
	return csrf_token();
});

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'laporan'], function () {
	Route::post('/', 'HomeController@addLaporan');
	Route::put('/', 'HomeController@updateLaporan');
	Route::get('/cetak', 'HomeController@cetakLaporan');
});

Route::group(['prefix' => 'zigzag'], function () {
	Route::get('/', 'ZigzagController@index');
	Route::get('/zig', 'ZigzagController@zigzag');
	Route::get('/vfoo', 'ZigzagController@viewFoo');
	Route::get('/vbar', 'ZigzagController@viewBar');
	Route::get('/foo', 'ZigzagController@foo');
	Route::post('/bar', 'ZigzagController@bar');
});

Route::group(['prefix' => 'konversi'], function () {
	Route::get('/', 'ZigzagController@letterConvertion');
});

Route::group(['prefix' => 'weton'], function () {
	Route::get('/', 'WetonController@index');
});
Route::group(['prefix' => 'map'], function () {
	Route::get('/', 'RiskMapController@map');
	Route::get('/show', 'RiskMapController@index');
});
