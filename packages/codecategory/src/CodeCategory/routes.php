<?php

Route::group(['prefix'=>'admin/categories','as'=>'admin.categories.','namespace'=>'CodePress\CodeCategory\Controllers',
	'middleware'=>['web', 'auth']],
function (){
   Route::get('',['uses'=>'AdminCategoryController@index','as'=>'index']);
   Route::get('/create',['uses'=>'AdminCategoryController@create','as'=>'create']);
   Route::post('/store',['uses'=>'AdminCategoryController@store','as'=>'store']);
});