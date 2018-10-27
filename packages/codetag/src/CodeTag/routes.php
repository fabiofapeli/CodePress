<?php

Route::group(['prefix'=>'admin/tags','as'=>'admin.tags.','namespace'=>'CodePress\CodeTag\Controllers','middleware'=>['web', 'authorization:access_tags']],function (){
   Route::get('',['uses'=>'AdminTagController@index','as'=>'index']);
   Route::get('/create',['uses'=>'AdminTagController@create','as'=>'create']);
   Route::post('/store',['uses'=>'AdminTagController@store','as'=>'store']);
});


