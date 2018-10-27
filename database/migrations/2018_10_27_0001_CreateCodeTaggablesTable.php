<?php
use \Illuminate\Database\Schema\Blueprint;

class CreateCodeTaggablesTable
{

    public function up(){
        Schema::create('codepress_taggables',function(Blueprint $table){
            $table->increments('tag_id');
            $table->string('taggable_id');
            $table->string('taggable_type');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::drop('codepress_taggables');
    }

}