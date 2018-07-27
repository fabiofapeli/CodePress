<?php

Route::group(['prefix'=>'admin/posts','as'=>'admin.posts.','namespace'=>'CodePress\CodePosts\Controllers','middleware'=>['web']],function (){
   Route::get('',['uses'=>'AdminPostController@index','as'=>'index']);
   Route::get('/create',['uses'=>'AdminPostController@create','as'=>'create']);
   Route::get('{id}/edit',['uses'=>'AdminPostController@edit','as'=>'edit']);
   Route::post('/store',['uses'=>'AdminPostController@store','as'=>'store']);
   Route::put('{id}/update',['uses'=>'AdminPostController@update','as'=>'update']);
   //verbo patch usado quando quer se atualizar apenas um campo
   Route::patch('{id}/update-state',['uses'=>'AdminPostController@updateState','as'=>'update_state']); 
});