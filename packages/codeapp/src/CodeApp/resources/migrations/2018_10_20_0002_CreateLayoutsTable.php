<?php
use Illuminate\Database\Schema\Blueprint;

class CreateLayoutsTable
{
    public function up(){
        Schema::create('codepress_layouts',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('dirname');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::drop('codepress_layouts');
    }
}