<?php
use Illuminate\Database\Schema\Blueprint;

class CreateCodeCategoriesTable
{
    public function up(){
        Schema::create('codepress_categories',function(Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id')->nullabe(true)->unsined()->default(0);
            $table->foreign('parent_id')->references('id')->on('codepress_categories');
            $table->string('name');
            $table->string('slug');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::drop('codepress_categories');
    }
}