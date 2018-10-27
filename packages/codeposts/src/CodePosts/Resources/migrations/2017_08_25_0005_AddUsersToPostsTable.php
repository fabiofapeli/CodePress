<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersToPostsTable{

	public function up(){
		Schema::table('codepress_posts', function (Blueprint $table){
			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('codepress_users');
		});
	}

	public function down(){
		Schema::table('codepress_posts', function (Blueprint $table){
			$table->dropForeign('codepress_posts_user_id_foreign');
			$table->removeColumn('user_id');
		});
	}
}
