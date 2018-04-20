<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodePostsTable{

	public function up(){
		Schema::create('codepress_posts', function (Blueprint $table){
			$table->increments('id');
			$table->string('title');
			$table->text('content');
			$table->string('slug');
			$table->timestamps();
		});
	}

	public function down(){
		Screma::drop('codepress_posts');
	}
}
