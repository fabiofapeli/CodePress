<?php
namespace CodePress\CodeTag\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model implements SluggableInterface
{
    use SluggableTrait, SoftDeletes;
    private $validator;
    protected $table = "codepress_tags";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];
    
    protected $sluggable = [
       'build_from' => 'name',
       'slug',
       'save_to' => 'slug',
       'unique' => true
   ];


    public function taggable(){
        $this->morphTo();
    }
   
    //Validator (opcional) - obriga que o método aceite somente o argumento se esse for uma instância de validator
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
            $this->getAttributes() 
       );
       
        if($validator->fails()){
        $this->errors = $validator->errors();
        return false;
        }

        return true;

   }


    
}