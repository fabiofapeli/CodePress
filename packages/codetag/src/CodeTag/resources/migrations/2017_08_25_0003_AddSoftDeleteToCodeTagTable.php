<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToCodeTagTable{

	public function up(){
		Schema::table('codepress_tags', function (Blueprint $table){
			$table->softDeletes();
		});
	}

	public function down(){
		Schema::table('codepress_tags', function (Blueprint $table){
			$table->dropColumn('deleted_at');
		});
	}
}
