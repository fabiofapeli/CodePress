<?php
namespace CodePress\CodeApp\Models;

use Illuminate\Database\Eloquent\Model;

/**
* @property string frontLayout
*/
class AppConfig extends Model
{

    protected $table = "codepress_appconfig" ;

    protected $fillable = [
        'options' 
    ];

    /*com a propriedade casts podemos transformar o formato de retorno dos campos da tabela.*/
    protected $casts = [
        'options' => 'array' // Ex: array, boolean, object
    ];

    protected $optionsFields = [
        'frontLayout'
    ];

    /*
        através do método mágico __get do php, poderemos pegar um valor de uma propriedade/variaveis que não existe na classe
    */
    public function __get($key)
    {
       if($key != 'options' && in_array($key, $this->optionsFields)){
            return parent::__get('options')[$key];
       }
       return parent::__get($key); 
    }

    /*
        através do método mágico __set, poderemos atribuir valor a uma propriedade/variaveis que não existe
    */
    public function __set($key, $value)
    {
        if($key != 'options' && in_array($key, $this->optionsFields)){
            $options = $this->options;
            $options[$key] = $value;
            return parent::__set('options', $options);
        }
        return parent::__set($key, $value); 
    }

}