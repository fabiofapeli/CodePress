<?php
namespace CodePress\CodeTag\Testing;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Models\Role;

class AdminTagsTest extends \TestCase
{
    
 use DatabaseTransactions;

  public function test_if_user_is_not_allowed(){

         $this->actingAs($this->getRedator())
         ->get('admin/categories')
         ->seeStatusCode(403);
      
    }	
 
   public function test_can_visit_admin_tags_page()
   {
        $this->actingAs($this->getAdmin()) // método irá autenticar o usuário
          ->visit('admin/tags')// Acessa página
          ->see('Tags'); // Verifica se teste pass
   }

    public function test_tags_listing()
   {
       Tag::create(['name'=>'Tag 1','active'=>'true']);
       Tag::create(['name'=>'Tag 2','active'=>'true']);
       Tag::create(['name'=>'Tag 3','active'=>'true']);
       Tag::create(['name'=>'Tag 4','active'=>'true']);
 
       $this->actingAs($this->getAdmin())->visit('admin/tags')
       ->see('Tag 1')
       ->see('Tag 2')
       ->see('Tag 3')
       ->see('Tag 4');
   }
   
   public function test_create_new_tag(){
       $this->actingAs($this->getAdmin())->visit('admin/tags/create')  
           ->type('Tag Test','name')          
           ->press('Create Tag')
           ->seePageIs('admin/tags')
           ->see('Tag Test'); // Faz o teste passar
           //->see('Category Testher'); Faz o teste falhar
   }

    protected function getRedator(){
      $redator = factory(User::class) ->create(); 
      $roleRedator = Role::where('name',Role::ROLE_REDATOR)->first();
      $redator->roles()->save($roleRedator); 
      return $redator;  
    }
    
    protected function getAdmin(){
      $admin = factory(User::class) ->create(); 
      $roleAdmin = Role::where('name',Role::ROLE_ADMIN)->first();
      $admin->roles()->save($roleAdmin); 
      return $admin;  
    }
}
