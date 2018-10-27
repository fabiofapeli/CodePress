<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeUserRolesTable{

	public function up(){
		Schema::create('codepress_user_roles', function (Blueprint $table){
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('codepress_users');
			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('codepress_roles');
		});
	}

	public function down(){
		Schema::drop('codepress_user_roles');
	}
}
