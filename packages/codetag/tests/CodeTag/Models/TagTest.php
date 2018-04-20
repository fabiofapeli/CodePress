<?php

namespace CodePress\CodeTag\Tests\CodeTag\Models;

use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Mockery as m;

class TagTest extends AbstractTestCase
{
    public function setUp(){
        parent::setUp();
        $this->migrate();
    }

    public function test_check_if_a_tag_can_be_persisted(){
        $tag = Tag::create(['name'=>'Tag Test']);
        $this->assertEquals('Tag Test',$tag->name);
        //$this->assertEquals('tag-test',$tag->slug);  Teste slug
    }
    
    public function test_inject_validator_in_tag_model(){
       $tag = new Tag();
       $validator = m::mock(Validator::class); // Uso do mockery para simular classe
       $tag->setValidator($validator);
 
       $this->assertEquals($tag->getValidator(), $validator);
   }
   
    public function test_should_check_if_is_valid_when_it_is(){
       $tag = new Tag();
       $tag->name = "Tag Test";
	
       $validator = m::mock(Validator::class); 
       
       $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']); //Falsificando regra de validação
       $validator->shouldReceive('setData')->with(['name' => 'Tag Test']); //Campo obrigatório para nova categoria
       $validator->shouldReceive('fails')->andReturn(false); //Retornamos o valor que nos interessa
       
       $tag->setValidator($validator);
       $this->assertTrue($tag->isValid());
   }
   
   public function test_should_check_if_it_is_invalid_when_it_is(){
        $tag = new Tag();
        $tag->name = "Tag Test";

        $messageBag = m::mock('Illuminate\Support\MessageBag'); // Simulando classe de erro
        $validator = m::mock(Validator::class); 

        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']); 
        $validator->shouldReceive('setData')->with(['name' => 'Tag Test']); 
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $tag->setValidator($validator);

        $this->assertFalse($tag->isValid());
        
        $this->assertEquals($messageBag, $tag->errors);
    }


}