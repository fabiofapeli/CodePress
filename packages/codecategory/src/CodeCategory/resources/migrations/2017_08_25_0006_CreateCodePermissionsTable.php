<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodePermissionsTable{

	public function up(){
		Schema::create('codepress_permissions', function (Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->text('description')->nullable(); //lembrar o que faz a permissão
			$table->timestamps();
		});
	}

	public function down(){
		Schema::drop('codepress_permissions');
	}
}
