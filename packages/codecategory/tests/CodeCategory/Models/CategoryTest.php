<?php
namespace CodePress\CodeCategory\Tests\Models;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeCategory\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Mockery as m;

class CategoryTest extends AbstractTestCase
{

    public function setUp(){
        parent::setUp();
        $this->migrate();
    }

    public function test_check_if_a_category_can_be_persisted(){

        $category = Category::create(['name' => 'Category Test', 'slug' => 'category-test', 'active' => true]);
        $this->assertEquals('Category Test',$category->name);

        $category = Category::all()->first();
        $this->assertEquals('Category Test',$category->name);

    }

    public function test_check_if_can_assign_a_parent_to_a_category(){

        $parentCategory = Category::create(['name' => 'Parent Test', 'slug' => 'parent-test', 'active' => true]);

        $category  = Category::create(['name'=>'Category Test', 'slug' => 'category-test','active' => true]);

        $category->parent()->associate($parentCategory)->save();

        $child = $parentCategory->children()->first();

        $this->assertEquals('Category Test',$child->name);
        $this->assertEquals('Parent Test',$category->parent->name);
    }

    public function test_inject_validator_in_category_model(){
       $category = new Category();
       $validator = m::mock(Validator::class); // Uso do mockery para simular classe
       $category->setValidator($validator);
       $this->assertEquals($category->getValidator(), $validator);
   }
   
   //Checar validação do model quando ele realmente é valido

   public function test_should_check_if_it_is_valid_when_it_is(){
       $category = new Category();
       $category->name = "Category Test";
       $validator = m::mock(Validator::class); // Uso do mockery para simular classe
       //shouldReceive é usado para simular um método
       $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']); //Falsificando regra de validação
       $validator->shouldReceive('setData')->with(['name' => 'Category Test']); //Campo obrigatório para a nova categoria
       $validator->shouldReceive('fails')->andReturn(false);
       
       $category->setValidator($validator);
       
       $this->assertTrue($category->isValid());
   }
   
   public function test_should_check_if_it_is_invalid_when_it_is(){
       $category = new Category();
       $category->name = "Category Test";
       
       $messageBag = m::mock('Illuminate\Support\MessageBag'); // Simulando classe de erro
       $validator = m::mock(Validator::class); 
       
       $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']); 
       $validator->shouldReceive('setData')->with(['name' => 'Category Test']); 
       $validator->shouldReceive('fails')->andReturn(true);
       $validator->shouldReceive('errors')->andReturn($messageBag);
       
       $category->setValidator($validator);
       
       $this->assertFalse($category->isValid());
       
       $this->assertEquals($messageBag, $category->errors);//Quando minha category tiver o atributo erro e for igual ao message bag significa que foi recebida a mensagem de erro do validador
       
   }


}