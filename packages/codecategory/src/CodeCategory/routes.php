<?php

Route::group(['prefix'=>'admin/categories','as'=>'admin.categories.','namespace'=>'CodePress\CodeCategory\Controllers',
	'middleware'=>['web', 'auth' , 'authorization:access_categories']],
function (){
   Route::get('',['uses'=>'AdminCategoryController@index','as'=>'index']);
   Route::get('create',['uses'=>'AdminCategoryController@create','as'=>'create']);
   Route::get('edit/{id}',['uses'=>'AdminCategoryController@edit','as'=>'edit']);
   Route::post('store',['uses'=>'AdminCategoryController@store','as'=>'store']);
   Route::put('update',['uses'=>'AdminCategoryController@update','as'=>'update']);
});