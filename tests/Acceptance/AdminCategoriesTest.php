<?php
namespace CodePress\CodeCategory\Testing;

use CodePress\CodeCategory\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Models\Role;

class AdminCategoriesTest extends \TestCase
{
	
	use DatabaseTransactions;

   public function test_if_user_is_not_allowed(){

         $this->actingAs($this->getRedator())
         ->get('admin/categories')
         ->seeStatusCode(403);
      
    }
	
    public function test_sample(){
        $this->actingAs($this->getAdmin()) // método irá autenticar o usuário
              ->visit('admin/categories')// Acessa página
              ->see('Categories'); // Verifica se teste passa
    }

    public function test_cannot_access_categories(){
        $this->visit('admin/categories')
              ->see('password'); 
    }

    public function test_categories_listing()
    {
        Category::create(['name'=>'Category 1','active'=>'true']);
        Category::create(['name'=>'Category 2','active'=>'true']);
        Category::create(['name'=>'Category 3','active'=>'true']);
        Category::create(['name'=>'Category 4','active'=>'true']);

        $this->actingAs($this->getAdmin())
             ->visit('admin/categories')
            ->see('Category 1')
            ->see('Category 2')
            ->see('Category 3')
            ->see('Category 4');
    }
    
    public function test_create_new_category(){
       $this->actingAs($this->getAdmin())
            ->visit('admin/categories/create')  
           ->type('Category Test','name')          
           ->check('active')
           ->press('Create Category')
           ->seePageIs('admin/categories')
           ->see('Category Test'); // Faz o teste passar
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
