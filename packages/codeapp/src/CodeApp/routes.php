<?php

Route::group([
	'prefix'=>'admin',
	'as'=>'admin.',
	'namespace'=>'\CodePress\CodeApp\Controllers',
	'middleware'=>['web', 'auth', 'authorization:access_users']
],function (){

	Route::group(['prefix' => 'layouts', 'as' => 'layouts.'], function(){

		Route::get('',['uses'=>'LayoutsController@index','as'=>'index']);
   		Route::get('/create',['uses'=>'LayoutsController@create','as'=>'create']);
  		Route::post('/store',['uses'=>'LayoutsController@store','as'=>'store']);
  		Route::get('/active/{id}',['uses'=>'LayoutsController@active','as'=>'active']);

	});
   
});