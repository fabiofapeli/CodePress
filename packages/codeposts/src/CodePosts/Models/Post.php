<?php
namespace CodePress\CodePosts\Models;

use CodePress\CodeCategory\Models\Category;
use CodePress\CodePosts\Models\Comment;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Validator;

class Post extends Model implements SluggableInterface

{
    const STATE_PUBLISHED = 1;
    const STATE_DRAFT = 2;

    use SluggableTrait, SoftDeletes;

    private $validator;

    protected $table = "codepress_posts" ;
    protected $dates = ['deleted_at'];

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
    return $this->morphToMany(Category::class, 'categorizable', 'codepress_categorizables');
   }


   public function comments(){
    return $this->hasMany(Comment::class);
   }


}