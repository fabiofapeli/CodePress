<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeCategorizablesTable{

	public function up(){
		Schema::create('codepress_categorizables', function (Blueprint $table){
			//Sem necessidade de criar chave estrangeira
			$table->integer('category_id');
			$table->integer('categorizable_id');
			$table->string('categorizable_type');
		});
	}

	public function down(){
		Schema::drop('codepress_categorizables');
	}
}
