<?php
namespace CodePress\CodeCategory\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements SluggableInterface

{

    use SluggableTrait, SoftDeletes;

    private $validator;

    protected $table = "codepress_categories" ;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    'name','slug','active','parent_id' // categoria poderá ter outra categoria como pai
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'unique'     => true
    ];

    public function parent(){
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }
/*
retirar
    public function categorizable(){ //O método categorizable será útil para permitir categorizar todos outros tipos de model. Ex: páginas, produtos e etc
        return $this->morphTo();
    }

*/

    public function posts(){
      return $this->morphedByMany('CodePress\CodePosts\Models\Post',
       //categorizable escopo para os campos de polimorfismo da tabela codepress_categorizables
       'categorizable', 
      //Como o nome da tabela não é categorizables (convenção laravel) devemos especificar o nome
      'codepress_categorizables'); 
    }

   public function setValidator(Validator $validator){
       $this->validator = $validator;
   }

   public function getValidator(){
       return $this->validator;
   }
   
   public function isValid(){
       $validator = $this->validator;
       $validator->setRules(['name' => 'required|max:255']);
       $validator->setData(
               $this->getAttributes() // Método do eloquent que retorna os atributos da instância atual
               );//Se não receber um atributo name o teste irá falhar
       
       if($validator->fails()){
           $this->errors = $validator->errors();
           return false;
       }
       
       return true;
   }

}