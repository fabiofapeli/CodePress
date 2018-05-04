<?php
namespace CodePress\CodePosts\Tests\Models;
use CodePress\CodePosts\Models\Post;
use CodePress\CodePosts\Models\Comment;
use CodePress\CodePosts\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Mockery as m;

class CommentTest extends AbstractTestCase
{

    public function setUp(){
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_comment_model(){
       $comment = new Comment();
       $validator = m::mock(Validator::class); // Uso do mockery para simular classe
       $comment->setValidator($validator);
       $this->assertEquals($comment->getValidator(), $validator);
   }
   
   //Checar validação do model quando ele realmente é valido

   public function test_should_check_if_it_is_valid_when_it_is(){
       $comment = new Comment();
       $comment->content = "Content of comment";

       $validator = m::mock(Validator::class); 
       $validator->shouldReceive('setRules')->with([
                                                    'content' => 'required'
                                                    ]); 

       $validator->shouldReceive('setData')->with([
                                                  'content' => 'Content of comment'
                                                  ]); 
       $validator->shouldReceive('fails')->andReturn(false);
       
       $comment->setValidator($validator);
       
       $this->assertTrue($comment->isValid());
   }
   
   public function test_should_check_if_it_is_invalid_when_it_is(){
       $comment = new comment();
       $comment->content = "Comment Test";
       
       $messageBag = m::mock('Illuminate\Support\MessageBag'); // Simulando classe de erro
       $validator = m::mock(Validator::class); 
       
       $validator->shouldReceive('setRules')->with([
                                                    'content' => 'required'
                                                    ]); 

       $validator->shouldReceive('setData')->with([
                                                  'content' => 'Comment Test'
                                                  ]); 

       $validator->shouldReceive('fails')->andReturn(true);
       $validator->shouldReceive('errors')->andReturn($messageBag);
       
       $comment->setValidator($validator);
       
       $this->assertFalse($comment->isValid());
       
       $this->assertEquals($messageBag, $comment->errors);
       
   }


    public function test_check_if_a_comment_can_be_persisted(){

      $post = Post::create(['title' => 'Post Test',  'content' => 'Conteudo do post']);
      $comment = Comment::create(['content' => 'Conteudo do comentário', 'post_id' => $post->id]);
      $this->assertEquals('Conteudo do comentário',$comment->content);

      $comment = Comment::all()->first();
      $this->assertEquals('Conteudo do comentário',$comment->content);
      $post = Comment::find(1)->post;
      $this->assertEquals('Post Test',$post->title);

    }


   //Teste integração
   public function test_can_validate_comment(){
       $comment = new Comment();
       $comment->content = "Conteudo do comentário";

       /*
       Chamando classe aplications do Laravel, acesso ao containner de serviços cadastrados
       Cria validator sem se preocupar com instância de objeto e dependências
       */
       $factory = $this->app->make('Illuminate\Validation\Factory');  
       $validator = $factory->make([], []);
       
       $comment->setValidator($validator);
       $this->assertTrue($comment->isValid());
       
   }

   public function test_can_force_delete_all_from_relationship(){
      $post = Post::create(['title' => 'Post Test',  'content' => 'Conteudo do post']);
      Comment::create(['content' => 'Conteudo do comentário 1', 'post_id' => $post->id]);
      Comment::create(['content' => 'Conteudo do comentário 2', 'post_id' => $post->id]);
      $post->comments()->forceDelete();
      $this->assertCount(0, $post->comments()->get());
   }

   public function test_can_restore_delete_all_from_relationship(){
      $post = Post::create(['title' => 'Post Test',  'content' => 'Conteudo do post']);
      $comment1 = Comment::create(['content' => 'Conteudo do comentário 1', 'post_id' => $post->id]);
      $comment2 = Comment::create(['content' => 'Conteudo do comentário 2', 'post_id' => $post->id]);
      $comment1->delete();
      $comment2->delete();
      $post->comments()->restore();
      $this->assertCount(2, $post->comments()->get());
   }
/*
   public function test_can_find_the_model_deleted_from_relationship(){
      $post = Post::create(['title' => 'Post Test',  'content' => 'Conteudo do post']);
      Comment::create(['content' => 'Conteudo do comentário 1', 'post_id' => $post->id]);
      $post->delete();
      $comment = Comment::find(1);
      $this->assertEquals('Post Test',$comment->post->title);
   }
*/
}