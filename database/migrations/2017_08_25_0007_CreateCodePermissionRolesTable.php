<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodePermissionRolesTable{

	public function up(){
		Schema::create('codepress_permission_roles', function (Blueprint $table){
			$table->integer('permission_id');
			$table->foreign('permission_id')->references('id')->on('codepress_permissions');
			$table->integer('role_id');
			$table->foreign('role_id')->references('id')->on('codepress_roles');
		});
	}

	public function down(){
		Schema::drop('codepress_permission_roles');
	}
}
