<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use CodePress\CodePosts\Models\Post;

class CreateCodePostsTable{

	public function up(){
		Schema::create('codepress_posts', function (Blueprint $table){
			$table->increments('id');
			$table->string('title');
			$table->text('content');
			$table->string('slug');
			$table->string('state')->default(Post::STATE_DRAFT);
			$table->timestamps();
		});
	}

	public function down(){
		Schema::drop('codepress_posts');
	}
}
