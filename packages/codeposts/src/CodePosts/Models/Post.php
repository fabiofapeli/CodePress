<?php
namespace CodePress\CodePosts\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Validation\Validator;

class Post extends Model implements SluggableInterface

{

    use SluggableTrait;

    private $validator;

    protected $table = "codepress_posts" ;

    protected $fillable = [
    'title','content','slug'
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
        'unique'     => true
    ];

   public function setValidator(Validator $validator){
       $this->validator = $validator;
   }

   public function getValidator(){
       return $this->validator;
   }
   
   public function isValid(){
       $validator = $this->validator;
       $validator->setRules([
        'title' => 'required|max:255',
        'content' => 'required'
        ]);
       $validator->setData(
               $this->getAttributes() // Método do eloquent que retorna os atributos da instância atual
               );//Se não receber um atributo name o teste irá falhar
       
       if($validator->fails()){
           $this->errors = $validator->errors();
           return false;
       }
       
       return true;
   }

   public function categories(){
    return $this->morphToMany('CodePress\CodeCategory\Models\Category', 'categorizable', 'codepress_categorizables');
   }

}