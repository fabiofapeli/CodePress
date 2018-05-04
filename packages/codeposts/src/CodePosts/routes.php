<?php

Route::group(['prefix'=>'admin/posts','as'=>'admin.posts.','namespace'=>'CodePress\CodePosts\Controllers','middleware'=>['web']],function (){
   Route::get('',['uses'=>'AdminPostController@index','as'=>'index']);
   Route::get('/create',['uses'=>'AdminPostController@create','as'=>'create']);
   Route::post('/store',['uses'=>'AdminPostController@store','as'=>'store']);
});