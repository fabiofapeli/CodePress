<?php
namespace CodePress\CodePosts\Models;

use CodePress\CodePosts\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Validator;

class Comment extends Model

{

    private $validator;

    use SoftDeletes;

    protected $table = "codepress_comments" ;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    'content','post_id'
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

   public function post(){
    return $this->belongsTo(Post::class); 
    //return $this->belongsTo(Post::class)->withTrashed(); //pode ser usado também para hasMany
   }

}