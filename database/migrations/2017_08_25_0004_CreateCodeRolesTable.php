<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeRolesTable{

	public function up(){
		Schema::create('codepress_roles', function (Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down(){
		Schema::drop('codepress_roles');
	}
}

