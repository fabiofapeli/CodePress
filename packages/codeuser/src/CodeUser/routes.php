<?php

Route::group([
	'prefix'=>'admin/users',
	'as'=>'admin.users.',
	'namespace'=>'CodePress\CodeUser\Controllers',
	'middleware'=>['web']
],function (){
   Route::get('',['uses'=>'UsersController@index','as'=>'index']);
   Route::get('/create',['uses'=>'UsersController@create','as'=>'create']);
   Route::post('/store',['uses'=>'UsersController@store','as'=>'store']);
});