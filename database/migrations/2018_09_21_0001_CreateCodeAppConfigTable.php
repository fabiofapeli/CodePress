<?php
use Illuminate\Database\Schema\Blueprint;

class CreateCodeAppConfigTable
{
    public function up(){
        Schema::create('codepress_appconfig',function(Blueprint $table){
            $table->increments('id');
            $table->longText('options');
            $table->timestamps();
        });


        $model = new \CodePress\CodeApp\Models\AppConfig();
        $options = [
            'frontLayout' => ''
        ];
        $model->options = $options;
        $model->save;
    }

    public function down(){
        Schema::drop('codepress_appconfig');
    }
}