<?php
namespace CodePress\CodePost\Testing;

use CodePress\CodePosts\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Models\Role;

class AdminPostsTest extends \TestCase
{
	
	use DatabaseTransactions;


  public function test_if_user_is_not_allowed(){
     $this
        ->get('admin/posts')
        ->seeStatusCode(403);
  }

  public function test_if_user_is_authenticated(){
    $redator = $this->getRedator();
    $this->actingAs($redator)
         ->visit('admin/posts')// Acessa página
         ->see('posts');
  }


    public function test_sample(){
        $redator = $this->getRedator();
        $this->actingAs($redator)
        ->visit('admin/posts')// Acessa página
        ->see('posts'); // Verifica se teste passa
        //->see('Categoriesss'); //Verifica se teste não passa
    }

   public function test_posts_listing()
    {
        Post::create(['title'=>'Post 1','content'=>'Conteudo Post 1']);
        Post::create(['title'=>'Post 2','content'=>'Conteudo Post 2']);
        Post::create(['title'=>'Post 3','content'=>'Conteudo Post 3']);
        Post::create(['title'=>'Post 4','content'=>'Conteudo Post 4']);

        $redator = $this->getRedator();
        $this->actingAs($redator)
        ->visit('admin/posts')
            ->see('Post 1')
            ->see('Post 2')
            ->see('Post 3')
            ->see('Post 4');
    } 

    
    public function test_create_new_post(){
       $redator = $this->getRedator();
        $this->actingAs($redator)
           ->visit('admin/posts/create')  
           ->type('Post Test','title')          
           ->type('Conteudo do meu post','content')          
           ->press('Create Post')
           ->seePageIs('admin/posts')
           ->see('Post Test');
           //->see('Conteudo do meu post');
   }


  public function test_update_a_post(){
       $post = Post::create(['title'=>'Post 1','content'=>'Conteudo do meu post']);
       $redator = $this->getRedator();
        $this->actingAs($redator)
           ->visit("admin/posts/{$post->id}/edit")  
           ->type('Post Alterado','title')          
           ->type('Conteudo do meu post','content')          
           ->press('Edit Post')
           ->seePageIs('admin/posts')
           ->see('Post Alterado');
   }


    public function test_click_edit_a_post(){
       $post = Post::create(['title'=>'Post 1','content'=>'Conteudo do meu post']);
       $redator = $this->getRedator();
        $this->actingAs($redator)
           ->visit('admin/posts')  
           ->click("link_edit_post_{$post->id}")          
           ->seePageIs("admin/posts/{$post->id}/edit")
           ->see('Edit post');
   }

  protected function getRedator(){
      $redator = factory(User::class) ->create(); 
      $roleRedator = Role::where('name',Role::ROLE_REDATOR)->first();
      $redator->roles()->save($roleRedator); 
      return $redator;  
  }
}
